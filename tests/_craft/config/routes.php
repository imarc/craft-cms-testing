<?php

return [
    // Project
    'submittal-manager/project/<id:\d+>'                                      => ['template' => 'submittal-manager/project/index'],
    'submittal-manager/project/<id:\d+>/create-submittal'                     => ['template' => 'submittal-manager/project/index'],
    'submittal-manager/project/<id:\d+>/edit-submittal'                       => ['template' => 'submittal-manager/project/index'],
    'submittal-manager/project/<id:\d+>/delete'                               => ['template' => 'submittal-manager/project/delete'],
    // Mechanical
    'submittal-manager/mechanical/<id:\d+>/information/new'                   => ['template' => 'submittal-manager/mechanical/index'],
    'submittal-manager/mechanical/<id:\d+>/<action:.+>'                       => ['template' => 'submittal-manager/mechanical/index'],
    'submittal-manager/mechanical/<action:.+>'                                => ['template' => 'submittal-manager/mechanical/index'],
    // Seismic v1
    'submittal-manager/seismic/*'                                             => ['template' => 'submittal-manager/seismic-v1/index'],
    'submittal-manager/seismic/v1/<id:\d+>'                                   => ['template' => 'submittal-manager/seismic-v1/index'],
    'submittal-manager/seismic/v1/<id:\d+>/<action:.+>'                       => ['template' => 'submittal-manager/seismic-v1/index'],
    'submittal-manager/seismic/v1/<designId:\d+>/braces/new'                  => ['template' => 'submittal-manager/seismic-v1/index'],
    'submittal-manager/seismic/v1/<designId:\d+>/braces/<id:\d+>'             => ['template' => 'submittal-manager/seismic-v1/index'],
    'submittal-manager/seismic/v1/<designId:\d+>/braces/<id:\d+>/<action:.+>' => ['template' => 'submittal-manager/seismic-v1/index'],
    'submittal-manager/seismic/v1/<designId:\d+>/file-upload/new'             => ['template' => 'submittal-manager/seismic-v1/index'],
    'submittal-manager/seismic/v1/<designId:\d+>/file-upload/<id:\d+>'        => ['template' => 'submittal-manager/seismic-v1/index'],
    'submittal-manager/bill-of-materials/v1/<id:\d+>'                         => 'anvil-module/seismic-design/bill-of-materials',
    // Seismic v2
    'submittal-manager/seismic/v2/<id:\d+>'                                   => ['template' => 'submittal-manager/seismic-v2/index'],
    'submittal-manager/seismic/v2/<id:\d+>/<action:.+>'                       => ['template' => 'submittal-manager/seismic-v2/index'],
    'submittal-manager/seismic/v2/<designId:\d+>/braces/new'                  => ['template' => 'submittal-manager/seismic-v2/index'],
    'submittal-manager/seismic/v2/<designId:\d+>/braces/<id:\d+>'             => ['template' => 'submittal-manager/seismic-v2/index'],
    'submittal-manager/seismic/v2/<designId:\d+>/braces/<id:\d+>/<action:.+>' => ['template' => 'submittal-manager/seismic-v2/index'],
    'submittal-manager/seismic/v2/<designId:\d+>/file-upload/new'             => ['template' => 'submittal-manager/seismic-v2/index'],
    'submittal-manager/seismic/v2/<designId:\d+>/file-upload/<id:\d+>'        => ['template' => 'submittal-manager/seismic-v2/index'],
    'submittal-manager/bill-of-materials/v2/<id:\d+>'                         => 'seismic-submittal/design/bill-of-materials',
    // Price Worksheets
    'price-sheets/worksheets'                                                 => ['template' => 'price-sheets/_worksheets'],
    'price-sheets/worksheet/<id:\d+>'                                         => ['template' => 'price-sheets/_worksheet'],
    'price-sheets/worksheet/new'                                              => ['template' => 'price-sheets/_worksheet'],
    'price-sheets/export/worksheet/<id:\d+>'                                  => 'price-worksheets/export/worksheet',
    // Resource downloads
    'resource/<fileTitle:.+>'                                                 => 'anvil-module/download/index',
];
