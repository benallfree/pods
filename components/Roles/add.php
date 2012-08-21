<div class="wrap pods-admin">
    <script>
        var PODS_URL = '<?php echo PODS_URL; ?>';
    </script>
    <div id="icon-pods" class="icon32"><br /></div>

    <form action="" method="post" class="pods-submittable">
        <div class="pods-submittable-fields">
            <input type="hidden" name="action" value="pods_admin_components" />
            <input type="hidden" name="component" value="<?php echo $component; ?>" />
            <input type="hidden" name="method" value="<?php echo $method; ?>" />
            <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('pods-component-' . $component . '-' . $method ); ?>" />

            <h2 class="italicized"><?php _e('Roles &amp; Capabilities: Add New Role', 'pods'); ?></h2>

            <img src="<?php echo PODS_URL; ?>/ui/images/pods-logo-notext-rgb-transparent.png" class="pods-leaf-watermark-right" />

            <div id="pods-wizard-box" class="pods-wizard-steps-2">
                <div id="pods-wizard-heading">
                    <ul>
                        <li class="pods-wizard-menu-current" data-step="1">
                            <i></i>
                            <span>1</span> <?php _e( 'Naming', 'pods' ); ?>
                            <em></em>
                        </li>
                        <li data-step="2">
                            <i></i>
                            <span>2</span> <?php _e( 'Capabilities', 'pods' ); ?>
                            <em></em>
                        </li>
                    </ul>
                </div>
                <div id="pods-wizard-main">
                    <div id="pods-wizard-panel-1" class="pods-wizard-panel">
                        <div class="pods-wizard-content">
                            <p><?php _e( 'Roles allow you to specify which capabilities a user should be able to do within WordPress.', 'pods' ); ?></p>
                        </div>

                        <div class="stuffbox">
                            <h3><label for="link_name"><?php _e( 'Name your new Role', 'pods' ); ?></label></h3>

                            <div class="inside pods-manage-field">
                                <div class="pods-field-option">
                                    <?php
                                        echo PodsForm::label( 'role_label', __( 'Label', 'pods' ), __( 'Users will see this as the name of their role', 'pods' ) );
                                        echo PodsForm::field( 'role_label', pods_var_raw( 'role_label', 'post' ), 'text', array( 'class' => 'pods-validate pods-validate-required' ) );
                                    ?>
                                </div>

                                <div class="pods-field-option">
                                    <?php
                                        echo PodsForm::label( 'role_name', __( 'Name', 'pods' ), __( 'You will use this name to programatically reference this role throughout WordPress', 'pods' ) );
                                        echo PodsForm::field( 'role_name', pods_var_raw( 'role_name', 'post' ), 'db', array( 'attributes' => array( 'data-sluggable' => 'role_label' ), 'class' => 'pods-validate pods-validate-required pods-slugged-lower' ) );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pods-wizard-panel-2" class="pods-wizard-panel">
                        <div class="pods-wizard-content">
                            <p><?php _e( 'Choose below which Capabilities you would like this new user role to have.', 'pods' ); ?></p>
                        </div>

                        <div class="stuffbox">
                            <h3><label for="link_name"><?php _e( 'Assign the Capabilities for', 'pods' ); ?> <strong class="pods-slugged" data-sluggable="role_label"></strong></label></h3>

                            <div class="inside pods-manage-field pods-dependency">
                                <div class="pods-field-option-group">
                                    <p><a href="#toggle" class="button" id="toggle_all"><?php _e( 'Toggle All Capabilities on / off', 'pods' ); ?></a></p>

                                    <div class="pods-pick-values pods-pick-checkbox pods-zebra">
                                        <ul>
                                            <?php
                                                $zebra = false;

                                                foreach ( $capabilities as $capability ) {
                                                    $checked = false;

                                                    if ( in_array( $capability, $defaults ) )
                                                        $checked = true;

                                                    $class = ( $zebra ? 'even' : 'odd' );

                                                    $zebra = ( !$zebra );
                                            ?>
                                                <li class="pods-zebra-<?php echo $class; ?>">
                                                    <?php echo PodsForm::field( 'capabilities[' . $capability . ']', pods_var_raw( 'capabilities[' . $capability . ']', 'post', $checked ), 'boolean', array( 'boolean_yes_label' => $capability ) ); ?>
                                                </li>
                                            <?php
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="pods-wizard-actions">
                        <div id="pods-wizard-toolbar">
                            <a href="#start" id="pods-wizard-start" class="button button-secondary"><?php _e( 'Start Over', 'pods' ); ?></a>
                            <a href="#next" id="pods-wizard-next" class="button button-primary" data-next="<?php esc_attr_e( 'Next Step', 'pods' ); ?>" data-finished="<?php esc_attr_e( 'Finished', 'pods' ); ?>" data-processing="<?php esc_attr_e( 'Processing', 'pods' ); ?>.."><?php _e( 'Next Step', 'pods' ); ?></a>
                        </div>
                        <div id="pods-wizard-finished">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    var pods_admin_submit_callback = function ( id ) {
        document.location = 'admin.php?page=pods&do=create';
    }

    jQuery( function ( $ ) {
        $( document ).Pods( 'validate' );
        $( document ).Pods( 'submit' );
        $( document ).Pods( 'wizard' );
        $( document ).Pods( 'dependency' );
        $( document ).Pods( 'advanced' );
        $( document ).Pods( 'confirm' );
        $( document ).Pods( 'sluggable' );

        var toggle_all = true;
        $( '#toggle_all' ).on( 'click', function ( e ) {
            e.preventDefault();

            $( '.pods-field.pods-boolean input[type="checkbox"]' ).prop( 'checked', toggle_all );

            toggle_all = ( !toggle_all );
        } );
    } );
</script>