<?php

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

namespace Pimcore\Bundle\DataHubBundle\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Pimcore\Model\DataObject\Data\Geopoint;

class GeopointType extends ObjectType
{
    protected static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            $config =
                [
                    'fields' => [
                        'longitude' => [
                            'type'    => Type::float(),
                            'resolve' => function (
                                $value = null,
                                $args = [],
                                $context,
                                ResolveInfo $resolveInfo = null
                            ) {
                                if ($value instanceof Geopoint) {
                                    return $value->getLongitude();
                                }

                                return null;
                            },
                        ],
                        'latitude'  => [
                            'type'    => Type::float(),
                            'resolve' => function (
                                $value = null,
                                $args = [],
                                $context,
                                ResolveInfo $resolveInfo = null
                            ) {
                                if ($value instanceof Geopoint) {
                                    return $value->getLatitude();
                                }

                                return null;
                            },
                        ],

                    ],
                ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}