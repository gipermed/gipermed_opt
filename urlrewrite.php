<?php
$arUrlRewrite=array (
  1 => 
  array (
    'CONDITION' => '#^/catalog/(similar|related)/(\\d+)/(\\?.*)?$#',
    'RULE' => 'COLLECTION_TYPE=$1&ID=$2',
    'ID' => '',
    'PATH' => '/catalog/section.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/catalog/(.+)/filter/(.+?)/apply/\\??(.*)#',
    'RULE' => 'SECTION_PATH=$1&SMART_FILTER_PATH=$2',
    'ID' => '',
    'PATH' => '/catalog/section.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/bitrix/services/yandex.market/trading/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/yandex.market/trading/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/manufacturers/([\\w\\-]+)/(\\?.*)?$#',
    'RULE' => 'CODE=$1',
    'ID' => NULL,
    'PATH' => '/manufacturers/detail.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/catalog/(.+)/(\\d+)/(\\?.*)?$#',
    'RULE' => 'SECTION_PATH=$1&ID=$2&cat_detail=y',
    'ID' => '',
    'PATH' => '/catalog/detail.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/product/(.+)/(\\?.*)?$#',
    'RULE' => 'ELEMENT_CODE=$1&cat_detail=y',
    'ID' => '',
    'PATH' => '/product/detail.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/catalog/(.+)/(\\?.*)?$#',
    'RULE' => 'SECTION_PATH=$1',
    'ID' => '',
    'PATH' => '/catalog/section.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/catalog/(\\?.*)?$#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/catalog/sections.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
