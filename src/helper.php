<?php


namespace Lobster;


/**
 * @param iterable $data
 * @return DataObject
 */
function _object(iterable $data = []) : DataObject
{
     return new DataObject($data);
}
