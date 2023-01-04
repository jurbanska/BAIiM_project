<?php

return array(
    'home_label'                => 'Home',
    'hide_dot_files'            => true,
    'list_folders_first'        => true,
    'list_sort_order'           => 'natcasesort',
    'theme_name'                => 'bootstrap',
    'date_format'               => 'Y-m-d H:i:s',

    'hidden_files' => array(
        '.ht*',
        '*/.ht*',
        'resources',
        'static',
        'resources/*',
        'analytics.inc',
        'header.php',
        'footer.php'
    ),

    'links_dirs_with_index' => false,
    'external_links_new_window' => true,
    'index_files' => array(
        'index.htm',
        'index.html',
        'index.php'
    ),

    'hash_size_limit' => 268435456, // 256 MB
    'reverse_sort' => array(
        // 'path/to/folder'
    ),

    'zip_dirs' => false,
    'zip_stream' => true,
    'zip_compression_level' => 0,
    'zip_disable' => array(
        // 'path/to/folder'
    ),
);
