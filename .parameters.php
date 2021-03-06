<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @var array $arCurrentValues
 */
use \Bitrix\Main\Localization\Loc as Loc;
use \Rover\Params;
use \Bitrix\Main\SystemException;
use \Bitrix\Main\Loader;

if(!Loader::includeModule('rover.params'))
	throw new SystemException('Module rover.params not found');

Loc::loadMessages(__FILE__);

require_once __DIR__ . '/class.php';

$arComponentParameters = [
	"PARAMETERS" => [
		"IBLOCK_TYPE" => [
			'PARENT'    => 'DATA_SOURCE',
			'NAME'      => Loc::getMessage('ROVER_SL__IBLOCK_TYPE'),
			"TYPE"      => "LIST",
			"VALUES"    => Params\Iblock::getTypes(),
			"REFRESH"   => "Y",
		],
		"IBLOCK_ID" => [
			"PARENT"    => "DATA_SOURCE",
			"NAME"      => Loc::getMessage("ROVER_SL__IBLOCK_ID"),
			"TYPE"      => "LIST",
			"VALUES"    => Params\Iblock::getByType($arCurrentValues['IBLOCK_TYPE']),
			"REFRESH"   => "Y",
		],
		"SECTION_ID" => [
			"PARENT"    => "DATA_SOURCE",
			"NAME"      => Loc::getMessage("ROVER_SL__SECTION_ID"),
			"TYPE"      => "LIST",
			"VALUES"    => Params\Iblock::getSections($arCurrentValues['IBLOCK_ID'],
				false,
				['empty' => Loc::getMessage('ROVER_SL__SECTION_ID_EMPTY')]),
			'REFRESH'   => "Y"
		],
		'ELEMENT_ID'    => [
			"PARENT"    => "DATA_SOURCE",
			"NAME"      => Loc::getMessage("ROVER_SL__ELEMENT_ID"),
			"TYPE"      => "LIST",
			"VALUES"    => Params\Iblock::getElements($arCurrentValues['IBLOCK_ID'],
				$arCurrentValues['SECTION_ID'],
				['empty' => Loc::getMessage('ROVER_SL__ELEMENT_ID_EMPTY')]),
		],
		'LINK_URL'    => [
			"PARENT"    => "DATA_SOURCE",
			"NAME"      => Loc::getMessage("ROVER_SL__LINK_URL"),
			"TYPE"      => "LIST",
			"VALUES"    => Params\Iblock::getProps($arCurrentValues['IBLOCK_ID']),
		],
		'LINK_NAME'    => [
			"PARENT"    => "DATA_SOURCE",
			"NAME"      => Loc::getMessage("ROVER_SL__LINK_NAME"),
			"TYPE"      => "LIST",
			"VALUES"    => Params\Iblock::getProps($arCurrentValues['IBLOCK_ID']),
		],
		"RESIZE" => [
			'PARENT'    => 'VISUAL',
			'NAME'      => Loc::getMessage("ROVER_SL__RESIZE"),
			'TYPE'      => 'CHECKBOX',
			'DEFAULT'   => 'N',
			'REFRESH'   => 'Y'
		],
		'CACHE_TIME' => ['DEFAULT' => 8640000]
	],
];

if ($arCurrentValues['RESIZE'] == 'Y') {

	$arComponentParameters['PARAMETERS']['RESIZE_WIDTH'] = [
		'PARENT'    => 'VISUAL',
		'NAME'      => Loc::getMessage("ROVER_SL__RESIZE_WIDTH"),
		'TYPE'      => 'STRING',
		'DEFAULT'   => RoverSlider::WIDTH_DEFAULT
	];

	$arComponentParameters['PARAMETERS']['RESIZE_HEIGHT'] = [
		'PARENT' => 'VISUAL',
		'NAME'  => Loc::getMessage("ROVER_SL__RESIZE_HEIGHT"),
		'TYPE'  => 'STRING',
		'DEFAULT'   => RoverSlider::HEIGHT_DEFAULT
	];

	$arComponentParameters['PARAMETERS']['RESIZE_SHARPEN'] = [
		'PARENT'    => 'VISUAL',
		'NAME'      => Loc::getMessage("ROVER_SL__RESIZE_SHARPEN"),
		'TYPE'      => 'STRING',
		'DEFAULT'   => RoverSlider::SHARPEN_DEFAULT
	];

	$arComponentParameters['PARAMETERS']['RESIZE_QUALITY'] = [
		'PARENT'    => 'VISUAL',
		'NAME'      => Loc::getMessage("ROVER_SL__RESIZE_QUALITY"),
		'TYPE'      => 'STRING',
		'DEFAULT'   => RoverSlider::QUALITY_DEFAULT
	];
}