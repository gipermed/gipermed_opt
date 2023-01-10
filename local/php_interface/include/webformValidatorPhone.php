<?php
use \Bitrix\Main\EventManager;

class WebformValidatorPhone
{
	function getDescription()
	{
		return [
			'NAME' => 				'phone_full', // идентификатор
			'DESCRIPTION' => 		'Полнота телефона', // наименование
			'TYPES' => 				['text'], // типы полей
			'SETTINGS' => 			[__CLASS__, 'getSettings'], // метод, возвращающий массив настроек
			'CONVERT_TO_DB' => 		[__CLASS__, 'toDB'], // метод, конвертирующий массив настроек в строку
			'CONVERT_FROM_DB' => 	[__CLASS__, 'fromDB'], // метод, конвертирующий строку настроек в массив
			'HANDLER' => 			[__CLASS__, 'doValidate'] // валидатор
		];
	}

	function getSettings()
	{
		return [];
	}

	function toDB($arParams)
	{
		// возвращаем сериализованную строку
		return serialize($arParams);
	}

	function fromDB($strParams)
	{
		// никаких преобразований не требуется, просто вернем десериализованный массив
		return unserialize($strParams);
	}

	function doValidate($arParams, $arQuestion, $arAnswers, $arValues)
	{
		global $APPLICATION;

		foreach ($arValues as $value) {
			$pure = preg_replace("/\D/", "", $value);

			// проверяем на пустоту
			if (strlen($pure) < 11) {
				$APPLICATION->ThrowException("Укажите сотовый телефон полностью");
				return false;
			}

		}

		// все значения прошли валидацию, вернем true
		return true;
	}
}


Bitrix\Main\EventManager::getInstance()->addEventHandlerCompatible(
	'form',
	'onFormValidatorBuildList',
	['WebformValidatorPhone', 'getDescription']
);
