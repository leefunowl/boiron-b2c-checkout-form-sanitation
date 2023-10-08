<?php
/**
 * Plugin Name:     Boiron B2C checkout form sanitation
 * Plugin URI:      https://leefun.us/
 * Description:     Sanitize Boiron B2C checkout form
 * Author:          Leefun
 * Author URI:      https://leefun.us/
 * Text Domain:     boiron-b2c-checkout-form-sanitation
 * Domain Path:     /languages
 * Version:         0.0.1
 *
 * @package         boiron-b2c-checkout-form-sanitation
 */

add_action( 'wp_footer','sanitize_checkout_form' );
function sanitize_checkout_form() {
?>

    <script type="text/javascript">
	
    document.addEventListener('DOMContentLoaded', () => {  
		
        
        const BillPhone = document.getElementById('billing_phone');
        BillPhone.setAttribute('maxlength', '10');
        const SanitizePhoneNumber = (e) => {
            let _value = e.target.value;
            _value = _value.replace(/[^0-9]+/g, '');
            BillPhone.value = _value;
        }
        BillPhone.addEventListener('input', SanitizePhoneNumber);
        
        const BillPhoneExtension = document.getElementById('billing_phone_extension');
        const SanitizePhoneExtensionNumber = (e) => {
            let _value = e.target.value;
            _value = _value.replace(/[^0-9]+/g, '');
            BillPhoneExtension.value = _value;
        }
        BillPhoneExtension.addEventListener('input', SanitizePhoneExtensionNumber);
        // document.getElementById('billing_phone_extension_field').style.marginLeft = '375px';
        
        const BillFirstName = document.getElementById('billing_first_name');
        BillFirstName.setAttribute('maxlength', '30');
        document.getElementById('billing_last_name').setAttribute('maxlength', '30');
        document.getElementById('billing_company').setAttribute('maxlength', '30');
        document.getElementById('billing_address_1').setAttribute('maxlength', '30');
        document.getElementById('billing_city').setAttribute('maxlength', '30');
        document.getElementById('billing_address_2').style.display = 'none';

        const StreetAddress = document.getElementById('billing_address_1_field');
        const Buzz = document.getElementById('billing_address_3_field');

        StreetAddress.parentNode.insertBefore(Buzz, StreetAddress.nextSibling);
    });

    </script>

<?php
 
}


// Add custom field on checkout page for Purolator tracking 
add_filter( 'woocommerce_checkout_fields' , 'leefun_add_phone_extension_field' );
function leefun_add_phone_extension_field( $fields ) {
     $fields['billing']['billing_phone_extension'] = array(
        'label'     => ('en' == apply_filters( 'wpml_current_language', null )) ? __('Extension', 'woocommerce') : __('Extension', 'woocommerce'),
        'placeholder'     => ('en' == apply_filters( 'wpml_current_language', null )) ? _x('Extension', 'placeholder', 'woocommerce') : _x('Extension', 'placeholder', 'woocommerce'),
        'required'  => false,
        'class'     => array('form-row-wide'),
        'clear'     => true,
        'type'      => 'tel',
        'maxlength' => 4,
     );

     return $fields;
}

?>