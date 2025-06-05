<?php
// Add admin menu item
add_action('admin_menu', 'add_migration_page');

function add_migration_page() {
    add_menu_page(
        'Migrate Attendees',
        'Migrate Attendees',
        'manage_options',
        'migrate-attendees',
        'migrate_attendees_page',
        'dashicons-update',
        30
    );
}

function update_team_member_from_attendee($team_member_id, $attendee_id) {
    // Map and copy basic fields
    $fields_map = array(
        'full_name' => 'full_name',
        'job_title' => 'role',
        'university' => 'company',
        'email' => 'email',
        'phone' => 'phone'
    );

    foreach ($fields_map as $attendee_field => $team_field) {
        $value = get_field($attendee_field, $attendee_id);
        if ($value) {
            update_field($team_field, $value, $team_member_id);
        }
    }

    // Copy social media links
    $socials = array(
        'instagram' => get_field('instagram', $attendee_id),
        'linkedin' => get_field('linkedin', $attendee_id)
    );
    update_field('socials', $socials, $team_member_id);

    // Set up info_new repeater field data
    $info_rows = array(
        array(
            'icon' => attachment_url_to_postid('https://harmony-network.org/wp-content/uploads/2025/03/mortarboard-1.png'),
            'title' => 'الخلفية الاكاديمية Academic CV',
            'content' => get_field('edu_resume', $attendee_id)
        ),
        array(
            'icon' => attachment_url_to_postid('https://harmony-network.org/wp-content/uploads/2025/03/resume.png'),
            'title' => 'السيرة المهنية Professional CV',
            'content' => get_field('pro_resume', $attendee_id)
        ),
        array(
            'icon' => attachment_url_to_postid('https://harmony-network.org/wp-content/uploads/2025/03/user-1.png'),
            'title' => 'السيرة الذاتية الشخصية Personal Bio',
            'content' => get_field('personal_resume', $attendee_id)
        ),
        array(
            'icon' => attachment_url_to_postid('https://harmony-network.org/wp-content/uploads/2025/03/puzzle.png'),
            'title' => 'المهارات Skills',
            'content' => get_field('fun_fact', $attendee_id)
        )
    );

    // Update the info_new repeater field
    update_field('info_new', $info_rows, $team_member_id);

    // Copy featured image if exists
    if (has_post_thumbnail($attendee_id)) {
        $thumbnail_id = get_post_thumbnail_id($attendee_id);
        set_post_thumbnail($team_member_id, $thumbnail_id);
    }
}

function migrate_attendees_page() {
    if (isset($_POST['migrate_selected']) && check_admin_referer('migrate_attendees_nonce')) {
        $selected_attendees = isset($_POST['selected_attendees']) ? $_POST['selected_attendees'] : array();
        
        if (empty($selected_attendees)) {
            echo '<div class="notice notice-error"><p>Please select at least one attendee to migrate.</p></div>';
        } else {
            $migrated = 0;
            $errors = array();

            foreach ($selected_attendees as $attendee_id) {
                $attendee = get_post($attendee_id);
                if (!$attendee) {
                    $errors[] = "Could not find attendee with ID: {$attendee_id}";
                    continue;
                }

                // Check if already migrated
                $existing = get_posts(array(
                    'post_type' => 'team',
                    'meta_query' => array(
                        array(
                            'key' => '_migrated_from_attendee',
                            'value' => $attendee_id
                        )
                    )
                ));

                if (!empty($existing)) {
                    // Update existing team member
                    update_team_member_from_attendee($existing[0]->ID, $attendee_id);
                    $migrated++;
                    continue;
                }

                // Create new team member
                $team_member = array(
                    'post_type' => 'team',
                    'post_title' => $attendee->post_title,
                    'post_status' => 'publish',
                    'post_author' => 1
                );

                $team_member_id = wp_insert_post($team_member);

                if (is_wp_error($team_member_id)) {
                    $errors[] = "Error creating team member for attendee {$attendee_id}: " . $team_member_id->get_error_message();
                    continue;
                }

                // Update the new team member
                update_team_member_from_attendee($team_member_id, $attendee_id);

                // Mark as migrated
                update_post_meta($team_member_id, '_migrated_from_attendee', $attendee_id);
                update_post_meta($attendee_id, '_migrated_to_team', $team_member_id);

                $migrated++;
            }

            echo '<div class="notice notice-success"><p>Migration completed! Successfully migrated: ' . $migrated . ' attendees.</p>';
            if (!empty($errors)) {
                echo '<p>Errors encountered:</p><ul>';
                foreach ($errors as $error) {
                    echo '<li>' . esc_html($error) . '</li>';
                }
                echo '</ul>';
            }
            echo '</div>';
        }
    }

    // Get all attendees
    $attendees = get_posts(array(
        'post_type' => 'attendees',
        'posts_per_page' => -1,
        'post_status' => 'any',
        'orderby' => 'title',
        'order' => 'ASC'
    ));

    // Get migration status for each attendee
    $migration_status = array();
    foreach ($attendees as $attendee) {
        $team_member_id = get_post_meta($attendee->ID, '_migrated_to_team', true);
        $migration_status[$attendee->ID] = array(
            'migrated' => !empty($team_member_id),
            'team_member_id' => $team_member_id
        );
    }
    ?>
    <div class="wrap">
        <h1>Migrate Attendees to Team Members</h1>
        
        <div class="card">
            <h2>Select Attendees to Migrate</h2>
            <p>Choose which attendees you want to migrate to team members. Already migrated attendees will be updated if selected again.</p>
            
            <form method="post" action="">
                <?php wp_nonce_field('migrate_attendees_nonce'); ?>
                
                <div style="margin: 10px 0;">
                    <button type="button" class="button" onclick="selectAll()">Select All</button>
                    <button type="button" class="button" onclick="deselectAll()">Deselect All</button>
                    <button type="button" class="button" onclick="selectNotMigrated()">Select Not Migrated</button>
                </div>

                <div style="max-height: 500px; overflow-y: auto; margin: 20px 0; padding: 10px; border: 1px solid #ccc;">
                    <table class="wp-list-table widefat fixed striped">
                        <thead>
                            <tr>
                                <th style="width: 30px;"></th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($attendees as $attendee): 
                                $status = $migration_status[$attendee->ID];
                                $status_text = $status['migrated'] ? 
                                    'Migrated (Team Member ID: ' . $status['team_member_id'] . ')' : 
                                    'Not Migrated';
                                $status_class = $status['migrated'] ? 'migrated' : 'not-migrated';
                            ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected_attendees[]" 
                                               value="<?php echo $attendee->ID; ?>" 
                                               class="attendee-checkbox <?php echo $status_class; ?>">
                                    </td>
                                    <td><?php echo $attendee->post_title; ?></td>
                                    <td><?php echo $status_text; ?></td>
                                    <td>
                                        <?php if ($status['migrated']): ?>
                                            <a href="<?php echo get_edit_post_link($status['team_member_id']); ?>" 
                                               class="button button-small" target="_blank">
                                                View Team Member
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <input type="submit" name="migrate_selected" class="button button-primary" value="Migrate Selected Attendees">
            </form>
        </div>
    </div>

    <style>
        .migrated {
            opacity: 0.8;
        }
    </style>

    <script>
        function selectAll() {
            document.querySelectorAll('.attendee-checkbox').forEach(cb => cb.checked = true);
        }

        function deselectAll() {
            document.querySelectorAll('.attendee-checkbox').forEach(cb => cb.checked = false);
        }

        function selectNotMigrated() {
            document.querySelectorAll('.attendee-checkbox').forEach(cb => {
                cb.checked = cb.classList.contains('not-migrated');
            });
        }
    </script>
    <?php
}