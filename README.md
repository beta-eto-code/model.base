## Установка

```
composer require beta/model.base
```

**Пример описания модели**

```php
use Model\Base\BaseModel;
use Model\Base\ModelDataLoader;
use Model\Base\SerializeStrategy;

class UserModel extends BaseModel
{
    public string $id;
    public string $name;
    public string $email;
    
    public static function initFromArray(array $data): ModelInterface
    {
        // ручной маппинг свойств
        $model = new UserMode();
        $model->id = $data['id'] ?: '';
        $model->name = $data['name'] ?: '';
        $this->email = $data['email'] ?: '';

        // или простой вариант если названия ключей совпадают с названиями свойств
        $model = new UserMode();
        ModelDataLoader::loadData($model, $data);
        
        // или с преобразованием ключей массива в CamelCase
        $model = new UserMode();
        ModelDataLoader::loadData($model, $data, SerializeStrategy::getCamelCase());
        
        // или с преобразованием ключей массива в snake_case
        $model = new UserMode();
        ModelDataLoader::loadData($model, $data, SerializeStrategy::getSnakeCase());
        
        return $model;
    }
    
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
```

**Пример описания модели с стратегией преобразования в массив**

```php
use Model\Base\BaseSerializableModel;
use Model\Base\ModelDataLoader;
use Model\Base\SerializeStrategy;

class UserModel extends BaseSerializableModel
{
    public string $id;
    public string $name;
    public string $lastName;
    public int $test_age;
    
    public static function initFromArray(array $data): ModelInterface
    {
        // ручной маппинг свойств
        $model = new UserMode();
        $model->id = $data['id'] ?: '';
        $model->name = $data['name'] ?: '';
        $this->lastName = $data['lastName'] ?: '';
        $this->test_age = $data['age'] ?: '';
        return $model;
    }
}

$user = UserModel::initFromArray(['id' => '1', 'name' => 'testName', 'lastName' => 'testLastName', 'age' => 31]);
$user->jsonSerialize(); // ['id' => '1', 'name' => 'testName', 'lastName' => 'testLastName', 'test_age' => 31]

$user->setSerializeStrategy(SerializeStrategy::getSnakeCase());
$user->jsonSerialize(); // ['id' => '1', 'name' => 'testName', 'last_name' => 'testLastName', 'test_age' => 31]

$user->setSerializeStrategy(SerializeStrategy::getCamelCase());
$user->jsonSerialize(); // ['id' => '1', 'name' => 'testName', 'lastName' => 'testLastName', 'testAge' => 31]
```
