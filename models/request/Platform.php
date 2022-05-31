<?php

namespace nikserg\ItcomPublicApi\models\request;

/**
 * Площадки, доступные для выпуска
 * 44FZ_223FZ - ЭП для 44-ФЗ, 223-ФЗ
 * 44_223_B2B15 - ЭП для 44-ФЗ, 223-ФЗ, B2B на 15 мес
 * 44_223_CDT15 - ЭП для 44-ФЗ, 223-ФЗ, ЦДТ на 15 мес
 * 44_223_FAB15 - ЭП для 44-ФЗ, 223-ФЗ, Фабрикант на 15 мес
 * 44_223_GPB15 - ЭП для 44-ФЗ, 223-ФЗ, ГПБ на 15 мес
 * 44_223_GPB_FAB_B2B15 - ЭП для 44-ФЗ, 223-ФЗ, ГПБ, Фабрикант, В2В на 15 мес
 * 44_223_GPB_FAB_B2B_CDT15 - ЭП 44-ФЗ, 223-ФЗ, ГПБ, Фабрикант, В2В, ЦДТ на 15 мес
 * AETP - АЭТП
 * AETP13 - АЭТП 1 год и 3 месяца
 * AETP13_NEW - КТП (АЭТП) 1 год и 3 месяца
 * AETP13_NEW_BASE - КТП (базовый) 1 год и 3 месяца
 * AETP_NEW - КТП (АЭТП)
 * AETP_NEW_BASE - КТП (базовый)
 * AIST - АИСТ
 * AIST_UTENDER_OTP - АИСТ, uTender, ОТП
 * AIST_UTENDER_OTP_13 - АИСТ, uTender, ОТП 15 месяцев
 * ALFALOT - Альфалот
 * ASTGOZ_MEMBER - Портал Поставщиков Москвы
 * ATC - Аукционный тендерный центр
 * A_EIS - Регистрация ЕИС
 * A_F_EETP - АО «Единая электронная торговая площадка»
 * A_F_MMVB - Национальная электронная площадка (ММВБ)
 * A_F_RTS223 - РТС Тендер по 223 ФЗ
 * A_F_RTS44 - РТС Тендер по 44 ФЗ
 * A_F_SBERBANKAST - Сбербанк - АСТ
 * A_F_ZAKAZRF - zakazrf.ru
 * B2B - B2B-Center
 * B2B13 - B2B-Center 1 год и 3 месяца
 * CDT_BUYER - ЦДТ «Участник торгов (покупатель)»
 * CDT_BUYER13 - ЦДТ «Участник торгов (покупатель)» 15 мес
 * CENTREAL - Центр Реализации
 * CENTREAL13 - Центр Реализации 1 год и 3 месяца
 * CLOUD_KTP_FABRIKANT - КТП (АЭТП) + Фабрикант
 * CLOUD_KTP_FABRIKANT_GPB - КТП (АЭТП) + Фабрикант + ГПБ
 * CRKI - Площадки для РИ
 * CRKI13 - Площадки для РИ 1 год и 3 месяца
 * EFRSDUL - ЕФРСФДЮЛ
 * EFRSDUL13 - ЕФРСФДЮЛ 1 год и 3 месяца
 * EGAIS - ЕГАИС
 * EGAIS_MEH - ЕГАИС «Маркировка»
 * EPGU - ЕПГУ
 * EPGU1 - ЕПГУ 1 месяц
 * EPGU13 - ЕПГУ 1 год и 3 месяца
 * EPGU3 - ЕПГУ 3 месяца
 * EPGU6 - ЕПГУ 6 месяцев
 * EPGU_NEP - ЕПГУ НЭП
 * ESP - ЭТП ЭСП
 * FABRIKANT - Фабрикант
 * FABRIKANT13 - Фабрикант 1 год и 3 месяца
 * FIS_FRDO_ADDITIONAL_PROFESSIONAL - ФИС ФРДО дополнительного профессионального образования
 * FIS_FRDO_ADDITIONAL_PROFESSIONAL13 - ФИС ФРДО дополнительного профессионального образования 1 год и 3 месяца
 * FIS_FRDO_ARCHIVE - ФИС ФРДО организаций, которым переданы архивы
 * FIS_FRDO_OO - ФИС ФРДО общеобразовательных организаций
 * FIS_FRDO_OO13 - ФИС ФРДО общеобразовательных организаций 1 год и 3 месяца
 * FIS_FRDO_PO - ФИС ФРДО среднего профессионального образования
 * FIS_FRDO_PO13 - ФИС ФРДО среднего профессионального образования 1 год и 3 месяца
 * FIS_FRDO_VO - ФИС ФРДО высшего образования
 * FIS_FRDO_VO13 - ФИС ФРДО высшего образования 1 год и 3 месяца
 * FOR_CUSTOMER_FZ223_13 - ЭП для заказчика 223 ФЗ на 15 месяцев
 * FSRAR - ФСРАР
 * FSRAR13 - ФСРАР 1 год и 3 месяца
 * FSRARL - ФСРАР для лицензиата
 * FSS - ФСС
 * FTP13_NEW_EPGU - ФТП (без коммерческих) 1 год и 3 месяца
 * FTP3_NEW_EPGU - ФТП (без коммерческих) на 3 месяца
 * FTP_NEW_EPGU - ФТП (без коммерческих)
 * FTS - ФТС
 * FTS13 - ФТС 1 год и 3 месяца
 * FTS_ALTASOFT - ФТС Альта-Софт
 * FTS_ALTASOFT13 - ФТС Альта-Софт 1 год и 3 месяца
 * FZ223 - ЭП для заказчика 223 ФЗ
 * FZ223_13 - ЭП для 44-ФЗ, 223-ФЗ на 15 мес
 * FZ223_13_FL - ЭП для заказчика 223 ФЗ на 15 месяцев ФЛ
 * GIIS_DMDK - ГИИС ДМДК
 * GPB - ГПБ
 * GPB13 - ГПБ 1 год и 3 месяца
 * MARKING - ЭП для маркировки
 * MED - Для медицинских работников
 * MFC - Росреестр МФЦ
 * MINPOTREB - ЭП для МПРУ
 * OFD - ОФД
 * OFD13 - ОФД 1 год и 3 месяца
 * PROLONGATION_BIDDING_B2B - ЭП для торгов + B2B
 * PROLONGATION_BIDDING_BANKRUPTCY - Тариф «ЭП Торги-банкротство»
 * PROLONGATION_BIDDING_BANKRUPTCY_OPTIMUM - ЭП для торгов по банкротству Оптимум
 * PROLONGATION_BIDDING_CDT - ЭП для торгов + ЦДТ
 * PROLONGATION_BIDDING_COMPLECT - Тариф «ЭП Торги-комплект»
 * PROLONGATION_BIDDING_FABRICANT - ЭП для торгов + Фабрикант
 * PROLONGATION_BISNES - Тариф «ЭП Бизнес»
 * PROLONGATION_BISNES_GPB - ЭП для торгов + Газпромбанк
 * PROLONGATION_BISNES_RJD - ЭП для торгов + РЖД
 * PROLONGATION_BISNES_ROSREESTR - ЭП для бизнеса + Росреестр
 * PROLONGATION_ELECTRONIC_BIDDING - Тариф «ЭП Электронные торги»
 * PROLONGATION_PERSON_EGRUL - Тариф «ЭП для физических лиц»
 * REGTORG - Регторг
 * RJD - РЖД
 * ROSFINMONITOR - Росфинмониторинг
 * ROSOBRNADZOR - Рособрнадзор или ФИС ФРДО для ОИВ
 * ROSOBRNADZOR13 - Рособрнадзор или ФИС ФРДО для ОИВ на 1 год и 3 месяца
 * ROSREESTR_ARBITRE - Росреестр для арбитражного управляющего
 * ROSREESTR_CADASTRE - Росреестр для кадастрового инженера
 * ROSREESTR_CADASTRE13 - Росреестр для кадастрового инженера 1 год и 3 месяца
 * ROSREESTR_CADASTREFL - Росреестр для кадастрового инженера (ФЛ)
 * ROSREESTR_CADASTREFL13 - Росреестр для кадастрового инженера (ФЛ) на 1 год и 3 месяца
 * ROSREESTR_CORRUPTION - Росреестр по противодействию коррупции
 * ROSREESTR_COURT - Росреестр: Председатель суда
 * ROSREESTR_FKP - ФГБУ «ФКП Росреестра»
 * ROSREESTR_FOIV - Росреестр для ТО ФОИВ
 * ROSREESTR_FOIV_NEW - Росреестр для ФОИВ
 * ROSREESTR_LEGAL - Росреестр для юридического лица
 * ROSREESTR_LEGAL13 - Росреестр для юридического лица 1 год и 3 месяца
 * ROSREESTR_LOCAL_CONTROL - Росреестр для руководителя подведомственной организации органа местного самоуправления (1
 * год) ROSREESTR_NOTARIUS - Росреестр для нотариуса ROSREESTR_OGV - Росреестр для ОГВ ROSREESTR_OGV13 - Росреестр для
 * ОГВ на 1 год и 3 месяца ROSREESTR_OIVS - Росреестр для органа исполнительной власти субъекта РФ ROSREESTR_OMS -
 * Росреестр для ОМС ROSREESTR_PERSON - Росреестр для физического лица ROSREESTR_PERSON13 - Росреестр для физического
 * лица на 1 год и 3 месяца ROSREESTR_PO - Росреестр для правоохранительного органа ROSREESTR_TERR - Росреестр и его
 * территориальные органы SBIS_G_U_R_EO_BASE - Тариф "СБИС ЭО-Базовый" SBIS_G_U_R_EO_CORPORATE - Тариф "СБИС
 * ЭО-Корпоративный" SBIS_G_U_R_EO_LIGHT - Тариф "СБИС ЭО-Легкий" SBIS_G_U_R_EO_UP - Тариф "СБИС ЭО-УП" SBIS_G_ZEROING
 * - Тариф Нулевой SBIS_I_CONTRACTOR - Установка по СБИС на рабочем месте Исполнителя SBIS_M_WORKPLACE - Перенос
 * рабочего места SBIS_NE_R_E_BASE_SEND_FCRAR - Неисключительные права использования СБИС для отправки отчетности в
 * ФСРАР SBIS_N_CONNECT - Новое подключение SBIS_O_ACCOUNT - Вывод в отдельный аккаунт SBIS_PROLONGATION - Продление по
 * действующей ЭП SBIS_RERELEASE - Перевыпуск SBIS_ROAMING - Роуминг SBIS_R_R_ESM - Право регистрации одного сотрудника
 * в СБИС с подписью на внешнем носителе SBIS_TRANSITION - Переход SBIS_U_R_BASE_SEND_REPORTING - Права использования
 * возможности СБИС для отправки отчетности в Росприроднадзор SBIS_U_R_EO_BASE_BUDGET - Права использования "СБИС
 * ЭО-Базовый, Бюджет SBIS_U_R_EO_BASE_IP - Права использования СБИС ЭО-Базовый, ИП SBIS_U_R_EO_BASE_OSNO - Права
 * использования "СБИС ЭО-Базовый, ОСНО SBIS_U_R_EO_BASE_REPORTING - Права использования "СБИС ЭО-Базовый"для сдачи
 * отчетности по дополнительному направлению SBIS_U_R_EO_BASE_USNO_ENVD - Права использования "СБИС ЭО-Базовый,
 * УСНО/ЕНВД SBIS_U_R_EO_CORPORATE_10 - Права использования возможности СБИС ЭО-Корпоративный для сдачи отчетности до
 * 10 компаний SBIS_U_R_EO_CORPORATE_25 - Права использования возможности СБИС ЭО-Корпоративный для сдачи отчетности до
 * 25 компаний SBIS_U_R_EO_CORPORATE_5 - Права использования возможности СБИС ЭО-Корпоративный для сдачи отчетности до
 * 5 компаний SBIS_U_R_EO_CORPORATE_50 - Права использования возможности СБИС ЭО-Корпоративный для сдачи отчетности до
 * 50 компаний SBIS_U_R_EO_LIGHT_BUDGET - Права использования "СБИС ЭО-Легкий, Бюджет SBIS_U_R_EO_LIGHT_IP - Права использования СБИС ЭО-Легкий, ИП SBIS_U_R_EO_LIGHT_OSNO - Права использования СБИС ЭО-Легкий, ОСНО SBIS_U_R_EO_LIGHT_REPORTING - Права использования СБИС ЭО-Легкий, для сдачи отчетности по доп.направлению SBIS_U_R_EO_LIGHT_USNO_ENVD - Права использования "СБИС ЭО-Легкий, УСНО/ЕНВД SBIS_U_R_EO_UP - Права использования "СБИС ЭО-УП" SBIS_U_R_EO_UP_MIN - Права использования "СБИС ЭО-УП-МИН" SBIS_U_R_EXTENDED - Права использования пакета Расширенный для СБИС SBIS_U_R_E_UP_1000 - Права использования "СБИС ЭО-УП-1000" SBIS_U_R_E_UP_200 - Права использования "СБИС ЭО-УП-200 SBIS_U_R_E_UP_MAX - Права использования "СБИС ЭО-УП-МАКС" SBIS_U_R_YEAR - Права использования аккаунта СБИС в течение 1 года SBIS_U_R_ZEROING - Права использования "СБИС Нулевка" SMEVAS - СМЭВ для автоматических систем SMEVDL - СМЭВ для должностных лиц TEKTORG - ТЭК-Торг TENDER_UG - Тендер ug UETP - УЭТП UETP13 - УЭТП на 15 мес. UNITED_TRADING_PLATFORMS - Объединенная торговая площадка URALBIDIN - UralBidIn URALBIDIN13 - UralBidIn на 15 мес. UTENDER - uTender
 */
class Platform
{
    public const _44FZ_223FZ = '44FZ_223FZ';
    public const _44_223_B2B15 = '44_223_B2B15';
    public const _44_223_CDT15 = '44_223_CDT15';
    public const _44_223_FAB15 = '44_223_FAB15';
    public const _44_223_GPB15 = '44_223_GPB15';
    public const _44_223_GPB_FAB_B2B15 = '44_223_GPB_FAB_B2B15';
    public const _44_223_GPB_FAB_B2B_CDT15 = '44_223_GPB_FAB_B2B_CDT15';
    public const AETP = 'AETP';
    public const AETP13 = 'AETP13';
    public const AETP13_NEW = 'AETP13_NEW';
    public const AETP13_NEW_BASE = 'AETP13_NEW_BASE';
    public const AETP_NEW = 'AETP_NEW';
    public const AETP_NEW_BASE = 'AETP_NEW_BASE';
    public const AIST = 'AIST';
    public const AIST_UTENDER_OTP = 'AIST_UTENDER_OTP';
    public const AIST_UTENDER_OTP_13 = 'AIST_UTENDER_OTP_13';
    public const ALFALOT = 'ALFALOT';
    public const ASTGOZ_MEMBER = 'ASTGOZ_MEMBER';
    public const ATC = 'ATC';
    public const A_EIS = 'A_EIS';
    public const A_F_EETP = 'A_F_EETP';
    public const A_F_MMVB = 'A_F_MMVB';
    public const A_F_RTS223 = 'A_F_RTS223';
    public const A_F_RTS44 = 'A_F_RTS44';
    public const A_F_SBERBANKAST = 'A_F_SBERBANKAST';
    public const A_F_ZAKAZRF = 'A_F_ZAKAZRF';
    public const B2B = 'B2B';
    public const B2B13 = 'B2B13';
    public const CDT_BUYER = 'CDT_BUYER';
    public const CDT_BUYER13 = 'CDT_BUYER13';
    public const CENTREAL = 'CENTREAL';
    public const CENTREAL13 = 'CENTREAL13';
    public const CLOUD_KTP_FABRIKANT = 'CLOUD_KTP_FABRIKANT';
    public const CLOUD_KTP_FABRIKANT_GPB = 'CLOUD_KTP_FABRIKANT_GPB';
    public const CRKI = 'CRKI';
    public const CRKI13 = 'CRKI13';
    public const EFRSDUL = 'EFRSDUL';
    public const EFRSDUL13 = 'EFRSDUL13';
    public const EGAIS = 'EGAIS';
    public const EGAIS_MEH = 'EGAIS_MEH';
    public const EPGU = 'EPGU';
    public const EPGU1 = 'EPGU1';
    public const EPGU13 = 'EPGU13';
    public const EPGU3 = 'EPGU3';
    public const EPGU6 = 'EPGU6';
    public const EPGU_NEP = 'EPGU_NEP';
    public const ESP = 'ESP';
    public const FABRIKANT = 'FABRIKANT';
    public const FABRIKANT13 = 'FABRIKANT13';
    public const FIS_FRDO_ADDITIONAL_PROFESSIONAL = 'FIS_FRDO_ADDITIONAL_PROFESSIONAL';
    public const FIS_FRDO_ADDITIONAL_PROFESSIONAL13 = 'FIS_FRDO_ADDITIONAL_PROFESSIONAL13';
    public const FIS_FRDO_ARCHIVE = 'FIS_FRDO_ARCHIVE';
    public const FIS_FRDO_OO = 'FIS_FRDO_OO';
    public const FIS_FRDO_OO13 = 'FIS_FRDO_OO13';
    public const FIS_FRDO_PO = 'FIS_FRDO_PO';
    public const FIS_FRDO_PO13 = 'FIS_FRDO_PO13';
    public const FIS_FRDO_VO = 'FIS_FRDO_VO';
    public const FIS_FRDO_VO13 = 'FIS_FRDO_VO13';
    public const FOR_CUSTOMER_FZ223_13 = 'FOR_CUSTOMER_FZ223_13';
    public const FSRAR = 'FSRAR';
    public const FSRAR13 = 'FSRAR13';
    public const FSRARL = 'FSRARL';
    public const FSS = 'FSS';
    public const FTP13_NEW_EPGU = 'FTP13_NEW_EPGU';
    public const FTP3_NEW_EPGU = 'FTP3_NEW_EPGU';
    public const FTP_NEW_EPGU = 'FTP_NEW_EPGU';
    public const FTS = 'FTS';
    public const FTS13 = 'FTS13';
    public const FTS_ALTASOFT = 'FTS_ALTASOFT';
    public const FTS_ALTASOFT13 = 'FTS_ALTASOFT13';
    public const FZ223 = 'FZ223';
    public const FZ223_13 = 'FZ223_13';
    public const FZ223_13_FL = 'FZ223_13_FL';
    public const GIIS_DMDK = 'GIIS_DMDK';
    public const GPB = 'GPB';
    public const GPB13 = 'GPB13';
    public const MARKING = 'MARKING';
    public const MED = 'MED';
    public const MFC = 'MFC';
    public const MINPOTREB = 'MINPOTREB';
    public const OFD = 'OFD';
    public const OFD13 = 'OFD13';
    public const PROLONGATION_BIDDING_B2B = 'PROLONGATION_BIDDING_B2B';
    public const PROLONGATION_BIDDING_BANKRUPTCY = 'PROLONGATION_BIDDING_BANKRUPTCY';
    public const PROLONGATION_BIDDING_BANKRUPTCY_OPTIMUM = 'PROLONGATION_BIDDING_BANKRUPTCY_OPTIMUM';
    public const PROLONGATION_BIDDING_CDT = 'PROLONGATION_BIDDING_CDT';
    public const PROLONGATION_BIDDING_COMPLECT = 'PROLONGATION_BIDDING_COMPLECT';
    public const PROLONGATION_BIDDING_FABRICANT = 'PROLONGATION_BIDDING_FABRICANT';
    public const PROLONGATION_BISNES = 'PROLONGATION_BISNES';
    public const PROLONGATION_BISNES_GPB = 'PROLONGATION_BISNES_GPB';
    public const PROLONGATION_BISNES_RJD = 'PROLONGATION_BISNES_RJD';
    public const PROLONGATION_BISNES_ROSREESTR = 'PROLONGATION_BISNES_ROSREESTR';
    public const PROLONGATION_ELECTRONIC_BIDDING = 'PROLONGATION_ELECTRONIC_BIDDING';
    public const PROLONGATION_PERSON_EGRUL = 'PROLONGATION_PERSON_EGRUL';
    public const REGTORG = 'REGTORG';
    public const RJD = 'RJD';
    public const ROSFINMONITOR = 'ROSFINMONITOR';
    public const ROSOBRNADZOR = 'ROSOBRNADZOR';
    public const ROSOBRNADZOR13 = 'ROSOBRNADZOR13';
    public const ROSREESTR_ARBITRE = 'ROSREESTR_ARBITRE';
    public const ROSREESTR_CADASTRE = 'ROSREESTR_CADASTRE';
    public const ROSREESTR_CADASTRE13 = 'ROSREESTR_CADASTRE13';
    public const ROSREESTR_CADASTREFL = 'ROSREESTR_CADASTREFL';
    public const ROSREESTR_CADASTREFL13 = 'ROSREESTR_CADASTREFL13';
    public const ROSREESTR_CORRUPTION = 'ROSREESTR_CORRUPTION';
    public const ROSREESTR_COURT = 'ROSREESTR_COURT';
    public const ROSREESTR_FKP = 'ROSREESTR_FKP';
    public const ROSREESTR_FOIV = 'ROSREESTR_FOIV';
    public const ROSREESTR_FOIV_NEW = 'ROSREESTR_FOIV_NEW';
    public const ROSREESTR_LEGAL = 'ROSREESTR_LEGAL';
    public const ROSREESTR_LEGAL13 = 'ROSREESTR_LEGAL13';
    public const ROSREESTR_LOCAL_CONTROL = 'ROSREESTR_LOCAL_CONTROL';
    public const ROSREESTR_NOTARIUS = 'ROSREESTR_NOTARIUS';
    public const ROSREESTR_OGV = 'ROSREESTR_OGV';
    public const ROSREESTR_OGV13 = 'ROSREESTR_OGV13';
    public const ROSREESTR_OIVS = 'ROSREESTR_OIVS';
    public const ROSREESTR_OMS = 'ROSREESTR_OMS';
    public const ROSREESTR_PERSON = 'ROSREESTR_PERSON';
    public const ROSREESTR_PERSON13 = 'ROSREESTR_PERSON13';
    public const ROSREESTR_PO = 'ROSREESTR_PO';
    public const ROSREESTR_TERR = 'ROSREESTR_TERR';
    public const SBIS_G_U_R_EO_BASE = 'SBIS_G_U_R_EO_BASE';
    public const SBIS_G_U_R_EO_CORPORATE = 'SBIS_G_U_R_EO_CORPORATE';
    public const SBIS_G_U_R_EO_LIGHT = 'SBIS_G_U_R_EO_LIGHT';
    public const SBIS_G_U_R_EO_UP = 'SBIS_G_U_R_EO_UP';
    public const SBIS_G_ZEROING = 'SBIS_G_ZEROING';
    public const SBIS_I_CONTRACTOR = 'SBIS_I_CONTRACTOR';
    public const SBIS_M_WORKPLACE = 'SBIS_M_WORKPLACE';
    public const SBIS_NE_R_E_BASE_SEND_FCRAR = 'SBIS_NE_R_E_BASE_SEND_FCRAR';
    public const SBIS_N_CONNECT = 'SBIS_N_CONNECT';
    public const SBIS_O_ACCOUNT = 'SBIS_O_ACCOUNT';
    public const SBIS_PROLONGATION = 'SBIS_PROLONGATION';
    public const SBIS_RERELEASE = 'SBIS_RERELEASE';
    public const SBIS_ROAMING = 'SBIS_ROAMING';
    public const SBIS_R_R_ESM = 'SBIS_R_R_ESM';
    public const SBIS_TRANSITION = 'SBIS_TRANSITION';
    public const SBIS_U_R_BASE_SEND_REPORTING = 'SBIS_U_R_BASE_SEND_REPORTING';
    public const SBIS_U_R_EO_BASE_BUDGET = 'SBIS_U_R_EO_BASE_BUDGET';
    public const SBIS_U_R_EO_BASE_IP = 'SBIS_U_R_EO_BASE_IP';
    public const SBIS_U_R_EO_BASE_OSNO = 'SBIS_U_R_EO_BASE_OSNO';
    public const SBIS_U_R_EO_BASE_REPORTING = 'SBIS_U_R_EO_BASE_REPORTING';
    public const SBIS_U_R_EO_BASE_USNO_ENVD = 'SBIS_U_R_EO_BASE_USNO_ENVD';
    public const SBIS_U_R_EO_CORPORATE_10 = 'SBIS_U_R_EO_CORPORATE_10';
    public const SBIS_U_R_EO_CORPORATE_25 = 'SBIS_U_R_EO_CORPORATE_25';
    public const SBIS_U_R_EO_CORPORATE_5 = 'SBIS_U_R_EO_CORPORATE_5';
    public const SBIS_U_R_EO_CORPORATE_50 = 'SBIS_U_R_EO_CORPORATE_50';
    public const SBIS_U_R_EO_LIGHT_BUDGET = 'SBIS_U_R_EO_LIGHT_BUDGET';
    public const SBIS_U_R_EO_LIGHT_IP = 'SBIS_U_R_EO_LIGHT_IP';
    public const SBIS_U_R_EO_LIGHT_OSNO = 'SBIS_U_R_EO_LIGHT_OSNO';
    public const SBIS_U_R_EO_LIGHT_REPORTING = 'SBIS_U_R_EO_LIGHT_REPORTING';
    public const SBIS_U_R_EO_LIGHT_USNO_ENVD = 'SBIS_U_R_EO_LIGHT_USNO_ENVD';
    public const SBIS_U_R_EO_UP = 'SBIS_U_R_EO_UP';
    public const SBIS_U_R_EO_UP_MIN = 'SBIS_U_R_EO_UP_MIN';
    public const SBIS_U_R_EXTENDED = 'SBIS_U_R_EXTENDED';
    public const SBIS_U_R_E_UP_1000 = 'SBIS_U_R_E_UP_1000';
    public const SBIS_U_R_E_UP_200 = 'SBIS_U_R_E_UP_200';
    public const SBIS_U_R_E_UP_MAX = 'SBIS_U_R_E_UP_MAX';
    public const SBIS_U_R_YEAR = 'SBIS_U_R_YEAR';
    public const SBIS_U_R_ZEROING = 'SBIS_U_R_ZEROING';
    public const SMEVAS = 'SMEVAS';
    public const SMEVDL = 'SMEVDL';
    public const TEKTORG = 'TEKTORG';
    public const TENDER_UG = 'TENDER_UG';
    public const UETP = 'UETP';
    public const UETP13 = 'UETP13';
    public const UNITED_TRADING_PLATFORMS = 'UNITED_TRADING_PLATFORMS';
    public const URALBIDIN = 'URALBIDIN';
    public const URALBIDIN13 = 'URALBIDIN13';
    public const UTENDER = 'UTENDER';
}