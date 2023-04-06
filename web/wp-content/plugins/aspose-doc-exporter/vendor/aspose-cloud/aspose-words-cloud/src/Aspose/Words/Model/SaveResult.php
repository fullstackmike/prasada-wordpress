<?php
/*
 * --------------------------------------------------------------------------------
 * <copyright company="Aspose" file="SaveResult.php">
 *   Copyright (c) 2021 Aspose.Words for Cloud
 * </copyright>
 * <summary>
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 * 
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 * 
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 * </summary>
 * --------------------------------------------------------------------------------
 */

namespace Aspose\Words\Model;
use \ArrayAccess;
use \Aspose\Words\ObjectSerializer;

/*
 * SaveResult
 *
 * @description Result of saving.
 */
class SaveResult implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /*
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = "SaveResult";

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'additional_items' => '\Aspose\Words\Model\FileLink[]',
        'dest_document' => '\Aspose\Words\Model\FileLink',
        'source_document' => '\Aspose\Words\Model\FileLink'
    ];

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $swaggerFormats = [
        'additional_items' => 'null',
        'dest_document' => 'null',
        'source_document' => 'null'
    ];

    /*
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /*
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /*
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'additional_items' => 'AdditionalItems',
        'dest_document' => 'DestDocument',
        'source_document' => 'SourceDocument'
    ];

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'additional_items' => 'setAdditionalItems',
        'dest_document' => 'setDestDocument',
        'source_document' => 'setSourceDocument'
    ];

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'additional_items' => 'getAdditionalItems',
        'dest_document' => 'getDestDocument',
        'source_document' => 'getSourceDocument'
    ];

    /*
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /*
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /*
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /*
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }



    /*
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /*
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['additional_items'] = isset($data['additional_items']) ? $data['additional_items'] : null;
        $this->container['dest_document'] = isset($data['dest_document']) ? $data['dest_document'] : null;
        $this->container['source_document'] = isset($data['source_document']) ? $data['source_document'] : null;
    }

    /*
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /*
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return true;
    }

    /*
     * Gets additional_items
     *
     * @return \Aspose\Words\Model\FileLink[]
     */
    public function getAdditionalItems()
    {
        return $this->container['additional_items'];
    }

    /*
     * Sets additional_items
     *
     * @param \Aspose\Words\Model\FileLink[] $additional_items Gets or sets the list of links to additional items (css, images etc).
     *
     * @return $this
     */
    public function setAdditionalItems($additional_items)
    {
        $this->container['additional_items'] = $additional_items;
        return $this;
    }

    /*
     * Gets dest_document
     *
     * @return \Aspose\Words\Model\FileLink
     */
    public function getDestDocument()
    {
        return $this->container['dest_document'];
    }

    /*
     * Sets dest_document
     *
     * @param \Aspose\Words\Model\FileLink $dest_document Gets or sets the link to destination document.
     *
     * @return $this
     */
    public function setDestDocument($dest_document)
    {
        $this->container['dest_document'] = $dest_document;
        return $this;
    }

    /*
     * Gets source_document
     *
     * @return \Aspose\Words\Model\FileLink
     */
    public function getSourceDocument()
    {
        return $this->container['source_document'];
    }

    /*
     * Sets source_document
     *
     * @param \Aspose\Words\Model\FileLink $source_document Gets or sets the link to source document.
     *
     * @return $this
     */
    public function setSourceDocument($source_document)
    {
        $this->container['source_document'] = $source_document;
        return $this;
    }

    /*
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /*
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /*
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /*
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /*
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

