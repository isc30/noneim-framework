<?php

/**
 * Request Type
 */
class RequestType extends Enum
{
    const Get = 'GET';
    const Head = 'HEAD';
    const Post = 'POST';
    const Put = 'PUT';
    const Delete = 'DELETE';
    const Connect = 'CONNECT';
    const Options = 'OPTIONS';
    const Trace = 'TRACE';
    const Patch = 'PATCH';
}