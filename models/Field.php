<?php

namespace nikserg\ItcomPublicApi\models;

/**
 * Поле формы анкеты заявки на сертификат
 *
 *
 */
class Field
{
    use ArrayConstructable;

    use ArrayConstructable {
        __construct as protected parent_construct;
    }

    public const ID_dnsName = 'dnsName';
    public const ID_organizationShortName = 'organizationShortName';
    public const ID_street = 'street';
    public const ID_departmentName = 'departmentName';
    public const ID_ownerPosition = 'ownerPosition';
    public const ID_email = 'email';
    public const ID_passportSeries = 'passportSeries';
    public const ID_SNILS = 'SNILS';
    public const ID_phone = 'phone';
    public const ID_fiasAddress = 'fiasAddress';
    public const ID_region = 'region';
    public const ID_city = 'city';
    public const ID_passportNumber = 'passportNumber';
    public const ID_passportDate = 'passportDate';
    public const ID_ownerCountry = 'ownerCountry';
    public const ID_ownerPassportDeptCode = 'ownerPassportDeptCode';
    public const ID_ownerBirthDate = 'ownerBirthDate';
    public const ID_ownerBirthPlace = 'ownerBirthPlace';
    public const ID_passportIssuer = 'passportIssuer';
    public const ID_ownerLastName = 'ownerLastName';
    public const ID_ownerFirstName = 'ownerFirstName';
    public const ID_ownerMiddleName = 'ownerMiddleName';
    public const ID_ownerGender = 'ownerGender';
    public const ID_ownerINN = 'ownerINN';
    public const ID_INN = 'INN';
    public const ID_INNFL = 'INNFL';
    public const ID_INNIP = 'INNIP';
    public const ID_OGRN = 'OGRN';
    public const ID_OGRNIP = 'OGRNIP';
    public const ID_KPP = 'KPP';
    public const ID_authorityDocumentType = 'authorityDocumentType';
    public const ID_authorityDocumentNumber = 'authorityDocumentNumber';
    public const ID_authorityDocumentDate = 'authorityDocumentDate';
    public const ID_authorityDocument = 'authorityDocument';
    public const ID_employeeTermAuthorityDocument = 'employeeTermAuthorityDocument';
    public const ID_employeeTermAuthorityDocumentDate = 'employeeTermAuthorityDocumentDate';
    public const ID_headLastName = 'headLastName';
    public const ID_headFirstName = 'headFirstName';
    public const ID_headMiddleName = 'headMiddleName';
    public const ID_safeEgrulOwner = 'safeEgrulOwner';
    public const ID_ipAfter2017 = 'ipAfter2017';
    public const ID_headPosition = 'headPosition';
    public const ID_ipAuthorityDate = 'ipAuthorityDate';
    public const ID_ipAuthoritySeries = 'ipAuthoritySeries';
    public const ID_ipAuthorityNumber = 'ipAuthorityNumber';
    public const ID_REVOCATION_CERTIFICATE_SERIAL_NUMBER = 'revocation_certificate_serial_number';

    public const VALUE_GENDER_MALE = 1;
    public const VALUE_GENDER_FEMALE = 2;

    public const GENDER_NAMES = [
        self::VALUE_GENDER_MALE   => 'Мужской',
        self::VALUE_GENDER_FEMALE => 'Женский',
    ];
    /**
     * Идентификатор поля
     *
     *
     * @var string
     */
    public string $id;

    /**
     * Человекопонятное название
     *
     *
     * @var string
     */
    public string $name;

    /**
     * Поле обязательно
     *
     *
     * @var bool
     */
    public bool $required;

    /**
     * Тип поля
     *
     *
     * @var string
     */
    public string $type;

    /**
     * Значение поля (если заполнено)
     *
     *
     * @var mixed
     */
    public mixed $value;

    /**
     * Группа полей заявки
     *
     *
     * @var FieldGroup|null
     */
    public ?FieldGroup $group;


    public function __construct(array $array)
    {
        if (isset($array['group'])) {
            $array['group'] = new FieldGroup($array['group']);
        }
        $this->parent_construct($array);
    }
}
