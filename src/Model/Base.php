<?php

namespace Model;

use Sys\Context as Context;

abstract class Base
{

    /**
     * @Id
     * @Column(type="guid", name="id")
     * @GeneratedValue(strategy="UUID")
     */
    protected $id;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function save()
    {
        Context::logger()->info('Save entity ' . get_class($this));

        Context::em()->persist($this);
        Context::em()->flush();
    }

    public function delete()
    {
        Context::logger()->info('Delete entity ' . get_class($this) . '(ID ' . $this->getId() . ')');

        Context::em()->remove($this);
        Context::em()->flush();
    }

    /**
     * 
     * @param string $id
     * @param string $what
     * @return \self
     * @throws \Sys\Exception\NotFound
     */
    public static function findOrFail(string $id, $what = null): self
    {
        $model = Context::em()->find(get_called_class(), $id);

        if ($model === null) {
            throw new \Sys\Exception\NotFound(($what !== null ? $what : str_replace('Model\\', '', get_called_class())) . ' not found');
        }

        return $model;
    }

    abstract public function toArray(): array;

}
