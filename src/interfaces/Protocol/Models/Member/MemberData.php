<?php namespace professionalweb\sendsay\interfaces\Protocol\Models\Member;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface for datakey
 * @package professionalweb\sendsay\Protocol\Models\Member
 */
interface MemberData extends Arrayable
{
    //<editor-fold desc="Constants">
    /**
     * полностью и безусловно заменить имеющиеся данные новыми
     * если значение присваивается элементу массива, и элемент ещё не существовал, и он не первый, то в массиве появится необходимое количество
     * элементов (со значением null) предшествующих присваемому
     */
    public const MODE_SET = 'set';

    /**
     * заменить имеющиеся данные новыми только указанный ключ уже есть
     * ("есть" это именно есть - null, пустая строка, путой массив, пустой объект находящиеся по указанному ключу -это "ключ есть")
     * иначе изменение игнорируется
     * поведение при присвоении не первому элементу массива аналогично set (при условии что замена реально была произведена)
     */
    public const MODE_UPDATE = 'update';

    /**
     * добавить данные только если указанного ключа ещё нет
     * ("нет" это именно нет - null, пустая строка, путой массив, пустой объект находящиеся по указанному ключу -это "ключ есть")
     * иначе изменение игнорируется
     * поведение при присвоении не первому элементу массива аналогично set (при условии что данные реально были добавлены)
     */
    public const MODE_INSERT = 'insert';

    /**
     * "set" по каждому ключу нового значения в сущестующее, а именно:
     * * если имеющиеся данные это объект и новое значение тоже объект, то каждый ключ и его величина из нового значения добавляются при отсутствии
     * или его величина заменяют собой величину существующего такого же ключа в имеющихся данных если ключ в них уже есть
     * * если данных по указанному ключу нет и новое значение объект, то новое значение создаст объект по указанному ключу
     * * в других случаях вызов завершится ошибкой
     */
    public const MODE_MERGE = 'merge';

    /**
     * "update" по каждому ключу нового значения в сущестующее, а именно:
     * * если имеющиеся данные это объект и новое значение тоже объект,то величина каждого ключа из нового значения заменяют собой величину
     * существующего такого же ключа в имеющихся данных. ключи нового значения отсутствующие в имеющихся данных игнорируются.
     * * если данных по указанному ключу нет и новое значение объект, то новое значение будет проигнорировано
     * в других случаях вызов завершится ошибкой
     */
    public const MODE_MERGE_UPDATE = 'merge_update';

    /**
     * "insert" по каждому ключу нового значения в сущестующее, а именно:
     * * если имеющиеся данные это объект и новое значение тоже объект, то каждый ключ и его величина из нового значения добавляются при отсутствии
     * такого ключа в имеющихся данных. ключи нового значения уже существующие в имеющихся данных игнорируются.
     * * если данных по указанному ключу нет и новое значение объект, то новое значение создаст объект по указанному ключу
     * * в других случаях вызов завершится ошибкой
     */
    public const MODE_MERGE_INSERT = 'merge_insert';

    /**
     * если имеющиеся данные это массив и новое значение тоже массив, то новый данные добавляются в конец имеющегося массива
     * если данных по указанному ключу нет и новое значение массив, то новое значение создаст массив по указанному ключу
     * в других случаях вызов завершится ошибкой
     */
    public const MODE_PUSH = 'push';

    /**
     * если имеющиеся данные это массив и новое значение тоже массив, то новый данные добавляются в начало имеющегося массива
     * если данных по указанному ключу нет и новое значение массив, то новое значение создаст массив по указанному ключу
     * в других случаях вызов завершится ошибкой
     */
    public const MODE_UNSHIFT = 'unshift';

    /**
     * данные будут удалены, "значение" и "тип" игнорируются и должны или отсутствовать или быть пустыми
     * - если удалялся элемент массива и он был последним, то размер массива уменьшится на 1
     * - если удалялся элемент массива и он не был последним, то размер массива не уменьшится, а удаляемый элемент получит значение null
     */
    public const MODE_DELETE = 'delete';

    /**
     * No validation
     */
    public const TYPE_NONE = null;

    /**
     * производится проверка и нормализация "значения" как даты для указанного диапазона точности от L до R
     * - где L и R - символы Y M D h m s задающие диапазон компонентов даты
     * - например "dt:Ys" - дата от года до секунды, "dt:Mh" - дата от месяца до часа
     * - год должен всегда задаваться четырмя цифрами
     * - остатальные компоненты - одной или двумя и они будут автоматически нормализованы до двух цифр
     * - например дата "1971-5-4 3:2:1" при типе "dt:Ys" станет "1971-05-04 03:02:01"
     */
    public const TYPE_NORMALIZE = 'dt:LR';

    //</editor-fold>

    /**
     * Get key
     *
     * @return string
     */
    public function getKey(): string;

    /**
     * Get mode
     *
     * @return string
     */
    public function getMode(): string;

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): string;

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string;
}