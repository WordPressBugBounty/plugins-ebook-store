<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Sell Ebook Widget Class.
 */
class Elementor_Sell_Ebook_Widget extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'sell_ebook';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Sell Ebook', 'ebook-store-extension' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-price-list'; // Elementor built-in book icon
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'ebook-store' ];
    }

    /**
     * Register the widget controls.
     */
    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Ebook Store', 'ebook-store-extension' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ebook_select',
            [
                'label'   => __( 'Select which ebook you want to embed', 'ebook-store-extension' ),
                'type'    => Controls_Manager::SELECT,
                'options' => $this->get_ebook_options(),
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Retrieve the list of ebooks for the dropdown.
     *
     * @return array List of ebooks.
     */
    private function get_ebook_options() {
        $ebooks = get_posts( [
            'post_type'   => 'ebook',
            'numberposts' => -1,
        ] );

        $options = [];
        foreach ( $ebooks as $ebook ) {
            $options[ $ebook->ID ] = $ebook->post_title;
        }

        return $options;
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $ebook_id = $settings['ebook_select'];

        if ( $ebook_id ) {
            echo '<div class="ebook-widget">';
            echo '<h3>' . esc_html( get_the_title( $ebook_id ) ) . '</h3>';
            echo do_shortcode('[ebook_store ebook_id="' . esc_attr($ebook_id) . '"]');
            echo '</div>';
        } else {
            echo '<div class="ebook-widget">' . __( 'No ebook selected.', 'ebook-store-extension' ) . '</div>';
        }
    }
}
