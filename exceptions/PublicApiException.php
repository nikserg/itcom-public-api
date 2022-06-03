<?php

namespace nikserg\ItcomPublicApi\exceptions;


use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

/**
 * Осмысленная ошибка от сервера CRM
 * [error] => Array
 * (
 * [type] => PublicApiMalformedRequestException
 * [code] => 400
 * [message] => При заполнении формы допущены следующие ошибки. email: Электронный адрес не является правильным E-Mail
 * адресом.; SNILS: СНИЛС должен содержать 11 цифр; ownerPassportDeptCode: Код подразделения должен содержать 6 цифр;
 * region: Регион отсутствует в списке. Пожалуйста, начните ввод, а затем выберите один из предложенных вариантов.;
 * passportDate: Неправильный формат поля Дата выдачи.; ownerBirthDate: Неправильный формат поля Дата рождения.; phone:
 * Укажите телефон в формате +ddddddddddd; INNFL: ИНН для физического лица и ИП должен содержать 12 символов
 * [line] => 203
 * [file] =>
 * /var/lib/jenkins/workspace/crm_develop/app/protected/modules/publicApi/controllers/CertificateController.php
 * [trace] => #0 [internal function]: PublicApiCertificateController->actionFill()
 * #1 /var/lib/jenkins/workspace/crm_develop/yii/framework/web/actions/CAction.php(108): ReflectionMethod->invokeArgs()
 * #2 /var/lib/jenkins/workspace/crm_develop/yii/framework/web/actions/CInlineAction.php(47):
 * CAction->runWithParamsInternal()
 * #3 /var/lib/jenkins/workspace/crm_develop/yii/framework/web/CController.php(308): CInlineAction->runWithParams()
 * #4 /var/lib/jenkins/workspace/crm_develop/yii/framework/web/CController.php(286): CController->runAction()
 * #5 /var/lib/jenkins/workspace/crm_develop/yii/framework/web/CController.php(265):
 * CController->runActionWithFilters()
 * #6 /var/lib/jenkins/workspace/crm_develop/yii/framework/web/CWebApplication.php(282): CController->run()
 * #7 /var/lib/jenkins/workspace/crm_develop/yii/framework/web/CWebApplication.php(141):
 * CWebApplication->runController()
 * #8 /var/lib/jenkins/workspace/crm_develop/yii/framework/base/CApplication.php(184):
 * CWebApplication->processRequest()
 * #9 /var/lib/jenkins/workspace/crm_develop/app/protected/core/components/WebApplication.php(91): CApplication->run()
 * #10 /var/lib/jenkins/workspace/crm_develop/app/index.php(84): WebApplication->run()
 * #11 {main}
 * )
 */
class PublicApiException extends Exception
{
    public string $publicApiExceptionClass;
    public ?string $publicApiLine;
    public ?string $publicApiFile;
    public ?string $publicApiTrace;


    public function __construct(array $json, ?Throwable $previous = null)
    {
        $type = $json['type'];
        $code = $json['code'];
        $message = $json['message'];
        $this->publicApiLine = $json['line'] ?? null;
        $this->publicApiFile = $json['file'] ?? null;
        $this->publicApiTrace = $json['trace'] ?? null;
        $this->publicApiExceptionClass = $type;
        parent::__construct($type . ': ' . $message, $code, $previous);
    }
}