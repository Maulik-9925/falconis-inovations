<?php
/**
 * Plugin Name: JBSoftTech Theme Options
 * Description: Custom theme options panel with logo upload and company information
 * Version: 1.0
 * Author: JBSoftTech
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class JBSoftTech_Theme_Options {
    
    private $options;
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }
    
    public function enqueue_admin_scripts($hook) {
        if ($hook != 'toplevel_page_jbsofttech-theme-options') {
            return;
        }
        
        wp_enqueue_media();
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('jbsofttech-admin-js', plugin_dir_url(__FILE__) . 'admin.js', array('jquery', 'wp-color-picker'), '1.0', true);
        wp_enqueue_style('jbsofttech-admin-css', plugin_dir_url(__FILE__) . 'admin.css', array(), '1.0');
    }
    
    public function add_plugin_page() {
        add_menu_page(
            'Theme Options', 
            'Theme Options', 
            'manage_options', 
            'jbsofttech-theme-options', 
            array($this, 'create_admin_page'),
            'dashicons-admin-generic',
            99
        );
    }
    
    public function create_admin_page() {
        $this->options = get_option('jbsofttech_theme_options');
        ?>
        <div class="wrap jbsofttech-options">
            <h1>Theme Options</h1>
            
            <div class="jbsofttech-header">
                <h2>Customize Your Website</h2>
                <p>Manage your site's appearance and information</p>
            </div>
            
            <form method="post" action="options.php">
            <?php
                settings_fields('jbsofttech_options_group');
                do_settings_sections('jbsofttech-theme-options');
                submit_button();
            ?>
            </form>
            
            <div class="jbsofttech-footer">
                <p>Developed By <strong>JBSoftTech</strong></p>
            </div>
        </div>
        <?php
    }
    
    public function page_init() {
        register_setting(
            'jbsofttech_options_group',
            'jbsofttech_theme_options',
            array($this, 'sanitize')
        );
        
        // Logo Section
        add_settings_section(
            'logo_section',
            'Logo Settings',
            array($this, 'logo_section_info'),
            'jbsofttech-theme-options'
        );
        
        add_settings_field(
            'logo_url',
            'Upload Logo',
            array($this, 'logo_url_callback'),
            'jbsofttech-theme-options',
            'logo_section'
        );
        
        add_settings_field(
            'logo_width',
            'Logo Width (px)',
            array($this, 'logo_width_callback'),
            'jbsofttech-theme-options',
            'logo_section'
        );
        
        add_settings_field(
            'logo_height',
            'Logo Height (px)',
            array($this, 'logo_height_callback'),
            'jbsofttech-theme-options',
            'logo_section'
        );
        
        // Company Information Section
        add_settings_section(
            'company_section',
            'Company Information',
            array($this, 'company_section_info'),
            'jbsofttech-theme-options'
        );
        
        add_settings_field(
            'company_name',
            'Company Name',
            array($this, 'company_name_callback'),
            'jbsofttech-theme-options',
            'company_section'
        );
        
        add_settings_field(
            'company_description',
            'Company Description',
            array($this, 'company_description_callback'),
            'jbsofttech-theme-options',
            'company_section'
        );
        
        add_settings_field(
            'company_address',
            'Address',
            array($this, 'company_address_callback'),
            'jbsofttech-theme-options',
            'company_section'
        );
        
        add_settings_field(
            'company_phone',
            'Phone Number',
            array($this, 'company_phone_callback'),
            'jbsofttech-theme-options',
            'company_section'
        );
        
        add_settings_field(
            'company_email',
            'Email Address',
            array($this, 'company_email_callback'),
            'jbsofttech-theme-options',
            'company_section'
        );
        
        // Appearance Section
        add_settings_section(
            'appearance_section',
            'Appearance Settings',
            array($this, 'appearance_section_info'),
            'jbsofttech-theme-options'
        );
        
        add_settings_field(
            'primary_color',
            'Primary Color',
            array($this, 'primary_color_callback'),
            'jbsofttech-theme-options',
            'appearance_section'
        );
        
        add_settings_field(
            'secondary_color',
            'Secondary Color',
            array($this, 'secondary_color_callback'),
            'jbsofttech-theme-options',
            'appearance_section'
        );
    }
    
    public function sanitize($input) {
        $sanitary_values = array();
        
        if (isset($input['logo_url'])) {
            $sanitary_values['logo_url'] = esc_url_raw($input['logo_url']);
        }
        
        if (isset($input['logo_width'])) {
            $sanitary_values['logo_width'] = absint($input['logo_width']);
        }
        
        if (isset($input['logo_height'])) {
            $sanitary_values['logo_height'] = absint($input['logo_height']);
        }
        
        if (isset($input['company_name'])) {
            $sanitary_values['company_name'] = sanitize_text_field($input['company_name']);
        }
        
        if (isset($input['company_description'])) {
            $sanitary_values['company_description'] = sanitize_textarea_field($input['company_description']);
        }
        
        if (isset($input['company_address'])) {
            $sanitary_values['company_address'] = sanitize_textarea_field($input['company_address']);
        }
        
        if (isset($input['company_phone'])) {
            $sanitary_values['company_phone'] = sanitize_text_field($input['company_phone']);
        }
        
        if (isset($input['company_email'])) {
            $sanitary_values['company_email'] = sanitize_email($input['company_email']);
        }
        
        if (isset($input['primary_color'])) {
            $sanitary_values['primary_color'] = sanitize_hex_color($input['primary_color']);
        }
        
        if (isset($input['secondary_color'])) {
            $sanitary_values['secondary_color'] = sanitize_hex_color($input['secondary_color']);
        }
        
        return $sanitary_values;
    }
    
    public function logo_section_info() {
        echo 'Customize your website logo settings';
    }
    
    public function logo_url_callback() {
        printf(
            '<div class="logo-upload">
                <img id="logo_preview" src="%s" style="%s" />
                <div>
                    <input type="hidden" id="logo_url" name="jbsofttech_theme_options[logo_url]" value="%s" />
                    <input type="button" class="button button-secondary" id="upload_logo_button" value="Upload Logo" />
                    <input type="button" class="button button-secondary" id="remove_logo_button" value="Remove Logo" style="%s" />
                </div>
            </div>',
            isset($this->options['logo_url']) ? esc_attr($this->options['logo_url']) : '',
            isset($this->options['logo_url']) ? 'max-width:300px;height:auto;margin-bottom:15px;' : 'display:none;',
            isset($this->options['logo_url']) ? esc_attr($this->options['logo_url']) : '',
            isset($this->options['logo_url']) ? '' : 'display:none;'
        );
    }
    
    public function logo_width_callback() {
        printf(
            '<input type="number" name="jbsofttech_theme_options[logo_width]" value="%s" />',
            isset($this->options['logo_width']) ? esc_attr($this->options['logo_width']) : ''
        );
    }
    
    public function logo_height_callback() {
        printf(
            '<input type="number" name="jbsofttech_theme_options[logo_height]" value="%s" />',
            isset($this->options['logo_height']) ? esc_attr($this->options['logo_height']) : ''
        );
    }
    
    public function company_section_info() {
        echo 'Enter your company information below';
    }
    
    public function company_name_callback() {
        printf(
            '<input type="text" class="regular-text" name="jbsofttech_theme_options[company_name]" value="%s" />',
            isset($this->options['company_name']) ? esc_attr($this->options['company_name']) : ''
        );
    }
    
    public function company_description_callback() {
        printf(
            '<textarea class="large-text" rows="5" name="jbsofttech_theme_options[company_description]">%s</textarea>',
            isset($this->options['company_description']) ? esc_attr($this->options['company_description']) : ''
        );
    }
    
    public function company_address_callback() {
        printf(
            '<textarea class="large-text" rows="3" name="jbsofttech_theme_options[company_address]">%s</textarea>',
            isset($this->options['company_address']) ? esc_attr($this->options['company_address']) : ''
        );
    }
    
    public function company_phone_callback() {
        printf(
            '<input type="text" class="regular-text" name="jbsofttech_theme_options[company_phone]" value="%s" />',
            isset($this->options['company_phone']) ? esc_attr($this->options['company_phone']) : ''
        );
    }
    
    public function company_email_callback() {
        printf(
            '<input type="email" class="regular-text" name="jbsofttech_theme_options[company_email]" value="%s" />',
            isset($this->options['company_email']) ? esc_attr($this->options['company_email']) : ''
        );
    }
    
    public function appearance_section_info() {
        echo 'Customize the appearance of your website';
    }
    
    public function primary_color_callback() {
        printf(
            '<input type="text" class="color-picker" name="jbsofttech_theme_options[primary_color]" value="%s" data-default-color="#3366cc" />',
            isset($this->options['primary_color']) ? esc_attr($this->options['primary_color']) : '#3366cc'
        );
    }
    
    public function secondary_color_callback() {
        printf(
            '<input type="text" class="color-picker" name="jbsofttech_theme_options[secondary_color]" value="%s" data-default-color="#ff9933" />',
            isset($this->options['secondary_color']) ? esc_attr($this->options['secondary_color']) : '#ff9933'
        );
    }
}

if (is_admin()) {
    $jbsofttech_theme_options = new JBSoftTech_Theme_Options();
}

// Create a shortcode to display company information
function jbsofttech_company_info_shortcode() {
    $options = get_option('jbsofttech_theme_options');
    ob_start();
    ?>
    <div class="jbsofttech-company-info">
        <?php if (!empty($options['company_name'])) : ?>
            <h3><?php echo esc_html($options['company_name']); ?></h3>
        <?php endif; ?>
        
        <?php if (!empty($options['company_description'])) : ?>
            <p><?php echo nl2br(esc_html($options['company_description'])); ?></p>
        <?php endif; ?>
        
        <?php if (!empty($options['company_address'])) : ?>
            <address><?php echo nl2br(esc_html($options['company_address'])); ?></address>
        <?php endif; ?>
        
        <?php if (!empty($options['company_phone'])) : ?>
            <p>Phone: <?php echo esc_html($options['company_phone']); ?></p>
        <?php endif; ?>
        
        <?php if (!empty($options['company_email'])) : ?>
            <p>Email: <a href="mailto:<?php echo esc_attr($options['company_email']); ?>"><?php echo esc_html($options['company_email']); ?></a></p>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('jbsofttech_company_info', 'jbsofttech_company_info_shortcode');

// Function to get logo HTML
function jbsofttech_get_logo() {
    $options = get_option('jbsofttech_theme_options');
    if (!empty($options['logo_url'])) {
        $style = '';
        if (!empty($options['logo_width'])) {
            $style .= 'width:' . $options['logo_width'] . 'px;';
        }
        if (!empty($options['logo_height'])) {
            $style .= 'height:' . $options['logo_height'] . 'px;';
        }
        
        return '<img src="' . esc_url($options['logo_url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '" style="' . $style . '" />';
    }
    return get_bloginfo('name');
}
?>

<?php
// Create admin.js file content
$admin_js_content = <<<'EOT'
jQuery(document).ready(function($) {
    // Color picker
    $('.color-picker').wpColorPicker();
    
    // Logo upload
    $('#upload_logo_button').click(function(e) {
        e.preventDefault();
        
        var custom_uploader = wp.media({
            title: 'Select Logo',
            button: {
                text: 'Use this image'
            },
            multiple: false
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#logo_url').val(attachment.url);
            $('#logo_preview').attr('src', attachment.url).show();
            $('#remove_logo_button').show();
        })
        .open();
    });
    
    // Remove logo
    $('#remove_logo_button').click(function(e) {
        e.preventDefault();
        $('#logo_url').val('');
        $('#logo_preview').hide();
        $(this).hide();
    });
});
EOT;

// Create admin.css file content
$admin_css_content = <<<'EOT'
.jbsofttech-options {
    max-width: 1000px;
}

.jbsofttech-options .jbsofttech-header {
    background: #fff;
    padding: 20px;
    margin: 20px 0;
    border-left: 4px solid #2271b1;
    box-shadow: 0 1px 1px rgba(0,0,0,0.04);
}

.jbsofttech-options .jbsofttech-header h2 {
    margin: 0;
    color: #2271b1;
}

.jbsofttech-options .jbsofttech-footer {
    margin-top: 30px;
    padding: 15px;
    text-align: center;
    border-top: 1px solid #ddd;
    color: #666;
}

.jbsofttech-options .form-table th {
    width: 200px;
    padding: 20px 10px 20px 0;
}

.jbsofttech-options .form-table td {
    padding: 15px 10px;
}

.jbsofttech-options .logo-upload {
    margin-bottom: 15px;
}

.jbsofttech-options .logo-upload img {
    max-width: 300px;
    height: auto;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    padding: 4px;
    background: #fff;
}

.jbsofttech-options .regular-text {
    width: 100%;
    max-width: 400px;
}

.jbsofttech-options .large-text {
    width: 100%;
    max-width: 600px;
}

.jbsofttech-options .color-picker {
    width: 100px;
}

.jbsofttech-options h2 {
    padding: 15px;
    background: #f8f8f8;
    border-bottom: 1px solid #e1e1e1;
}

.jbsofttech-options .submit {
    margin-top: 20px;
    padding: 20px;
    background: #f8f8f8;
    border-top: 1px solid #e1e1e1;
}
EOT;

// Create the files
$plugin_dir = plugin_dir_path(__FILE__);

// Create admin.js file
file_put_contents($plugin_dir . 'admin.js', $admin_js_content);

// Create admin.css file
file_put_contents($plugin_dir . 'admin.css', $admin_css_content);