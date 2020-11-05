<?php
/**
 * Actions class.
 *
 * @since 1.0.0
 *
 * @package OMAPI
 * @author  Thomas Griffin
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Actions class.
 *
 * @since 1.0.0
 */
class OMAPI_Actions {

	/**
	 * Holds the class object.
	 *
	 * @since 1.0.0
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * Path to the file.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $file = __FILE__;

	/**
	 * Holds any action notices.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $notices = array();

	/**
	 * Holds the base class object.
	 *
	 * @since 1.0.0
	 *
	 * @var object
	 */
	public $base;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Set our object.
		$this->set();

		// Add validation messages.
		add_action( 'admin_init', array( $this, 'actions' ) );
		add_action( 'admin_init', array( $this, 'fetch_missing_data' ), 99 );
		add_action( 'admin_notices', array( $this, 'notices' ) );

	}

	/**
	 * Sets our object instance and base class instance.
	 *
	 * @since 1.0.0
	 */
	public function set() {

		self::$instance = $this;
		$this->base     = OMAPI::get_instance();
		$this->view     = isset( $_GET['optin_monster_api_view'] ) ? stripslashes( $_GET['optin_monster_api_view'] ) : $this->base->get_view();
		$this->optin_id = isset( $_GET['optin_monster_api_id'] ) ? absint( $_GET['optin_monster_api_id'] ) : false;

	}

	/**
	 * Process admin actions.
	 *
	 * @since 1.0.0
	 */
	public function actions() {

		// Ensure action is set and correct and the optin is set.
		$action = isset( $_GET['optin_monster_api_action'] ) ? stripslashes( $_GET['optin_monster_api_action'] ) : false;
		if ( ! $action || 'edit' == $action ) {
			return;
		}

		// Verify the nonce URL.
		if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'omapi-action' ) ) {
			return;
		}

		// Prepare variable of args for admin notice.
		$args                                  = array();
		$args['optin_monster_api_action_done'] = $action;

		switch ( $action ) {
			case 'status':
				if ( $this->status() ) {
					$args['optin_monster_api_action_type'] = 'success';
					$args['optin_monster_api_action_id']   = $this->optin_id;
				} else {
					$args['optin_monster_api_action_type'] = 'error';
				}
				break;

			case 'cookies':
				if ( $this->cookies() ) {
					$args['optin_monster_api_action_type'] = 'success';
				} else {
					$args['optin_monster_api_action_type'] = 'error';
				}
				break;
			default:
				break;
		}

		// Now redirect to prevent reloads from undoing actions.
		$this->base->menu->redirect_to_dashboard( 'optins', $args );
	}

	/**
	 * Changes the status of an optin.
	 *
	 * @since 1.0.0
	 */
	public function status() {

		// Prepare variables.
		$status = (bool) get_post_meta( $this->optin_id, '_omapi_enabled', true );
		$new    = $status ? false : true;
		$field  = 'global';
		$type   = get_post_meta( $this->optin_id, '_omapi_type', true );

		switch ( $type ) {
			case 'post':
				$field = 'automatic';
				break;
			case 'sidebar':
				$field = false;
				break;
			default:
				break;
		}

		// Maybe update the global/automatic status.
		if ( $field ) {
			update_post_meta( $this->optin_id, '_omapi_' . $field, $new );
		}

		// Set enabled status.
		return update_post_meta( $this->optin_id, '_omapi_enabled', $new );

	}

	/**
	 * Changes test mode for the optin.
	 *
	 * @since 1.0.0
	 */
	public function test() {

		$status = (bool) get_post_meta( $this->optin_id, '_omapi_test', true );
		$new    = $status ? false : true;
		return update_post_meta( $this->optin_id, '_omapi_test', $new );

	}

	/**
	 * Clears the local cookies.
	 *
	 * @since 1.0.0
	 */
	public function cookies() {

		$optins = $this->base->get_optins( array( 'post_status' => 'any' ) );
		if ( ! empty( $optins ) ) {
			foreach ( (array) $optins as $optin ) {
				if ( $optin ) {
					// Array of ids so all splits are included
					$ids = get_post_meta( $optin->ID, '_omapi_ids', true );
					foreach ( (array) $ids as $id ) {
						setcookie( 'om-' . $id, '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
						setcookie( 'om-success-' . $id, '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
						setcookie( 'omSuccess-' . $id, '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
						setcookie( 'om-second-' . $id, '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
						setcookie( 'omSlideClosed-' . $id, '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
						setcookie( 'omSeen-' . $id, '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
						setcookie( 'om-' . $id . '-closed', '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
					}
				}
			}
		}

		// Clear out global cookie.
		setcookie( 'om-global-cookie', '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
		setcookie( 'omGlobalSuccessCookie', '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
		// Clear out interaction cookie.
		setcookie( 'om-interaction-cookie', '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
		setcookie( 'omGlobalInteractionCookie', '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
		// Clear out generic success cookie.
		setcookie( 'om-success-cookie', '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
		setcookie( 'omSuccessCookie', '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
		setcookie( 'omSessionStart', '', -1, COOKIEPATH, COOKIE_DOMAIN, false );
		setcookie( 'omSessionPageviews', '', -1, COOKIEPATH, COOKIE_DOMAIN, false );

		return true;

	}

	/**
	 * Retrieves a notice message for an admin action.
	 *
	 * @since 1.0.0
	 *
	 * @param string $action  The admin action to target.
	 * @param string $type    The type of notice to retrieve.
	 * @return string $notice The admin notice.
	 */
	public function get_notice( $action, $type = 'success' ) {
		$notice = '';

		switch ( $action ) {
			case 'status':
				if ( 'success' === $type ) {
					$url = $this->base->menu->get_settings_link(
						'optins',
						array(
							'optin_monster_api_action' => 'edit',
							'optin_monster_api_id'     => $this->optin_id,
						)
					);

					$notice = sprintf( __( 'The campaign status was updated successfully. You can configure more specific loading requirements by <a href="%s" title="Click here to edit the output settings for the updated campaign.">editing the output settings</a> for the campaign.', 'optin-monster-api' ), esc_url_raw( $url ) );
				} else {
					$notice = esc_html__( 'There was an error updating the campaign status. Please try again.', 'optin-monster-api' );
				}

				break;
			case 'cookies':
				$notice = 'success' === $type
					? esc_html__( 'The local cookies have been cleared successfully.', 'optin-monster-api' )
					: esc_html__( 'There was an error clearing the local cookies. Please try again.', 'optin-monster-api' );
				break;
			default:
				break;
		}

		return $notice;
	}

	/**
	 * Outputs any action notices.
	 *
	 * @since 1.0.0
	 */
	public function notices() {

		// Check to see if any notices should be output based on query args.
		$action = isset( $_GET['optin_monster_api_action_done'] ) ? strip_tags( stripslashes( $_GET['optin_monster_api_action_done'] ) ) : false;
		$type   = isset( $_GET['optin_monster_api_action_type'] ) ? strip_tags( stripslashes( $_GET['optin_monster_api_action_type'] ) ) : false;

		// Maybe set the optin ID if it is available.
		if ( isset( $_GET['optin_monster_api_action_id'] ) ) {
			$this->optin_id = absint( $_GET['optin_monster_api_action_id'] );
		}

		if ( $action && $type ) {
			$this->notices[ $type ] = $this->get_notice( $action, $type );
		}

		foreach ( $this->notices as $id => $message ) {
			echo '<div class="notice notice-' . esc_attr( $id ) . '"><p>' . $message . '</p></div>';
		}

	}

	/**
	 * When the plugin is first installed
	 * Or Migrated from a pre-1.8.0 version
	 * We need to fetch some additional data
	 *
	 * @since 1.8.0
	 *
	 * @return void
	 */
	public function fetch_missing_data() {
		$creds   = $this->base->get_api_credentials();
		$option  = $this->base->get_option();
		$changed = false;

		// If we don't have an API Key yet, we can't fetch anything else.
		if ( empty( $creds['apikey'] ) && empty( $creds['user'] ) && empty( $creds['key'] ) ) {
			return;
		}

		// Fetch the userId and accountId, if we don't have them
		if ( empty( $option['userId'] ) || empty( $option['accountId'] ) ) {
			$api  = OMAPI_Api::build( 'v2', 'me', 'GET' );
			$body = $api->request();

			if ( isset( $body->id, $body->accountId ) ) {
				$option['userId']    = $body->id;
				$option['accountId'] = $body->accountId;
				$changed             = true;
			}
		}

		// Fetch the SiteIds for this site, if we don't have them
		if ( empty( $option['siteIds'] ) || empty( $option['siteId'] ) || $this->siteIdsAreNumeric( $option['siteIds'] ) ) {

			$result = $this->base->sites->fetch();
			if ( ! is_wp_error( $result ) ) {
				$option  = array_merge( $option, $result );
				$changed = true;
			}
		}

		// Only update the option if we've changed something
		if ( $changed ) {
			update_option( 'optin_monster_api', $option );
		}

	}


	/**
	 * In one version of the Plugin, we fetched the numeric SiteIds,
	 * But we actually needed the alphanumeric SiteIds.
	 *
	 * So we use this check to determine if we need to re-fetch Site Ids
	 *
	 * @param array $siteIds
	 * @return bool True if the ids are numeric
	 */
	protected function siteIdsAreNumeric( $site_ids ) {
		foreach ( $site_ids as $id ) {
			if ( ! ctype_digit( (string) $id ) ) {
				return false;
			}
		}

		return true;
	}
}
