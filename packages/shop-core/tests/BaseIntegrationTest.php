<?php

namespace ShopCore\Tests;

use Carbon\Carbon;
use ShopCore\PersistanceLayer\Models\Category;
use ShopCore\PersistanceLayer\Models\Product;
use Tests\TestCase;

class BaseIntegrationTest extends TestCase
{
    public static $dbInited = [];

    protected $modelMapping = [
        'categories' => Category::class,
        'products' => Product::class,
    ];

    protected function setUp()
    {
        parent::setUp();

        if (!array_key_exists(static::class, static::$dbInited)) {
            $this->afterApplicationCreated(function () {
                $this->foreignKeyChecksOff();
                $this->cleanTables();
                foreach ($this->getDataFixtures() as $fixture) {
                    $this->applyFixture($fixture);
                }
                $this->foreignKeyChecksOn();
            });
            self::$dbInited[static::class] = true;
        }
    }

    protected function foreignKeyChecksOff(): void
    {
        $this->app->make('db')->statement('SET FOREIGN_KEY_CHECKS=0');
    }

    public function cleanTables()
    {
        foreach ($this->modelMapping as $model) {
            $model::query()->truncate();
        }
    }

    protected function getDataFixtures()
    {
        return [];
    }

    protected function applyFixture(string $fixturePath)
    {
        $fixtureData = @json_decode(file_get_contents($this->getFixturePath($fixturePath)), true);
        if (!$fixtureData) {
            throw new \Exception(sprintf('Invalid json "%s"', $fixturePath));
        }
        foreach ($fixtureData as $modelClassName => $data) {
            if (array_key_exists($modelClassName, $this->modelMapping)) {
                $modelClassName = $this->modelMapping[$modelClassName];
            }
            foreach ($data as $modelItem) {
                $model = new $modelClassName();
                foreach ($modelItem as $fieldName => $fieldValue) {
                    $model->{$fieldName} = $fieldValue;
                }
                $model->save();
            }
        }
    }

    /**
     * @param $filePath
     *
     * @throws \Exception
     * @throws \ReflectionException
     *
     * @return string
     */
    protected function getFixturePath(string $filePath): string
    {
        if (is_file($filePath)) {
            return $filePath;
        }
        $reflector = new \ReflectionClass(static::class);
        $fn = $reflector->getFileName();
        $pathWithFolder = sprintf('%s/DataFixtures/%s', dirname($fn), $filePath);
        if (is_file($pathWithFolder)) {
            return $pathWithFolder;
        }

        throw new \Exception(sprintf('Can\'t load file: "%s" ("%s")', $filePath, $pathWithFolder));
    }

    protected function foreignKeyChecksOn(): void
    {
        $this->app->make('db')->statement('SET FOREIGN_KEY_CHECKS=1');
    }

    protected function arrayOfObjectsToArray($arrOfObj): array
    {
        return array_map(function ($obj) {
            $methods = array_filter(
                array_combine(get_class_methods($obj), get_class_methods($obj)),
                function ($name) {
                    return 'get' === substr($name, 0, 3);
                },
                ARRAY_FILTER_USE_KEY
            );

            return array_map(function ($m) use ($obj) {
                $value = $obj->{$m}();
                if ($value instanceof Carbon) {
                    $value = (string) $value;
                } elseif (is_object($value)) {
                    $value = $this->arrayOfObjectsToArray([$value]);
                }

                return $value;
            }, $methods);
        }, $arrOfObj);
    }
}
