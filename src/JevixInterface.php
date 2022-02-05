<?php

namespace AJUR\Jevix;

interface JevixInterface
{
    /**
     * КОНФИГУРАЦИЯ: Разрешение тегов
     * Все не разрешённые теги считаются запрещёнными
     * @param array|string $tags тег(и)
     * @return $this
     */
    public function cfgAllowTags($tags): self;
    
    /**
     * КОНФИГУРАЦИЯ: Коротие теги типа <img>
     * @param array|string $tags тег(и)
     * @return $this
     */
    public function cfgSetTagShort($tags): self;
    
    /**
     * КОНФИГУРАЦИЯ: Преформатированные теги, в которых всё заменяется на HTML сущности типа <pre>
     * @param array|string $tags тег(и)
     * @return $this
     */
    public function cfgSetTagPreformatted($tags): self;
    
    /**
     * КОНФИГУРАЦИЯ: Теги в которых отключено типографирование типа <code>
     * @param array|string $tags тег(и)
     * @return $this
     */
    public function cfgSetTagNoTypography($tags): self;
    
    /**
     * КОНФИГУРАЦИЯ: Не короткие теги которые не нужно удалять с пустым содержанием, например, <param name="code"
     * value="die!"></param>
     * @param array|string $tags тег(и)
     * @return $this
     */
    public function cfgSetTagIsEmpty($tags): self;
    
    /**
     * КОНФИГУРАЦИЯ: Теги внутри который не нужна авто-расстановка <br>, например, <ul></ul> и <ol></ol>
     * @param array|string $tags тег(и)
     * @return $this
     */
    public function cfgSetTagNoAutoBr($tags): self;
    
    /**
     * КОНФИГУРАЦИЯ: Тег необходимо вырезать вместе с контентом (script, iframe)
     * @param array|string $tags тег(и)
     * @return $this
     */
    public function cfgSetTagCutWithContent($tags): self;
    
    /**
     * КОНФИГУРАЦИЯ: После тега не нужно добавлять дополнительный <br>
     * @param array|string $tags тег(и)
     * @return $this
     */
    public function cfgSetTagBlockType($tags): self;
    
    /**
     * КОНФИГУРАЦИЯ: Добавление разрешённых параметров тега
     * @param string $tag тег
     * @param string|array $params разрешённые параметры
     * @return $this
     */
    public function cfgAllowTagParams(string $tag, $params): self;
    
    /**
     * КОНФИГУРАЦИЯ: Добавление необходимых параметров тега
     * @param string $tag тег
     * @param string|array $params разрешённые параметры
     * @return $this
     */
    public function cfgSetTagParamsRequired(string $tag, $params): self;
    
    /**
     * КОНФИГУРАЦИЯ: Установка тегов которые может содержать тег-контейнер
     * @param string $tag тег
     * @param string|array $childs разрешённые теги
     * @param bool $isContainerOnly тег является только контейнером других тегов и не может содержать текст
     * @param bool $isChildOnly вложенные теги не могут присутствовать нигде кроме указанного тега
     * @return $this
     */
    public function cfgSetTagChilds(string $tag, $childs, bool $isContainerOnly = false, bool $isChildOnly = false): self;
    
    /**
     * КОНФИГУРАЦИЯ: Установка дефолтных значений для атрибутов тега
     * @param string $tag тег
     * @param string $param атрибут
     * @param string $value значение
     * @param bool $isRewrite заменять указанное значение дефолтным
     * @return $this
     */
    public function cfgSetTagParamDefault(string $tag, string $param, string $value, bool $isRewrite = false): self;
    
    /**
     * КОНФИГУРАЦИЯ: Устанавливаем callback-функцию на обработку содержимого тега
     * @param string $tag тег
     * @param mixed $callback функция
     * @return $this
     */
    public function cfgSetTagCallback(string $tag, $callback = null): self;
    
    /**
     * КОНФИГУРАЦИЯ: Устанавливаем callback-функцию на обработку тега (полностью)
     * @param string $tag тег
     * @param mixed $callback функция
     * @return $this
     */
    public function cfgSetTagCallbackFull(string $tag, $callback = null): self;
    
    /**
     * КОНФИГУРАЦИЯ: Устанавливаем комбинации значений параметров для тега
     *
     * @param string $tag тег
     * @param string $param атрибут
     * @param array $aCombinations Список комбинаций значений. Пример:
     *              array('myvalue'=>array('attr1'=>array('one','two'),'attr2'=>'other'))
     * @param bool $bRemove Удаляеть тег или нет, если в списке нет значения основного атрибута
     * @return $this
     */
    public function cfgSetTagParamCombination(string $tag, string $param, array $aCombinations, bool $bRemove = false): self;
    
    /**
     * @param string $text
     * @param $errors
     * @return string
     */
    public function parse(string $text, &$errors): string;
    
    /**
     * Возвращает массив правил
     *
     * @return array
     */
    public function getRules():array;
    
    
    
}