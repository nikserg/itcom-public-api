<?php

namespace nikserg\ItcomPublicApi\exceptions;

/**
 * Ошибка, которая возникает внутри CRM при вызове удаленных API
 * Например, когда старая CRM обращается к новому ядру
 */
class PublicApiRemoteException extends PublicApiException
{
}
