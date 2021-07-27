<?php

namespace Bermuda\DataObject;

/**
 * @param iterable $data
 * @return DataObject
 */
function _object(iterable $data = []): DataObject
{
     return new DataObject($data);
}
