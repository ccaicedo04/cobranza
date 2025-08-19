<?php
class Paginator
{
    public int $page;
    public int $perPage;
    public int $total;

    public function __construct(int $total, int $page = 1, int $perPage = 10)
    {
        $this->total = $total;
        $this->page = max(1, $page);
        $this->perPage = $perPage;
    }

    public function offset(): int
    {
        return ($this->page - 1) * $this->perPage;
    }

    public function pages(): int
    {
        return (int)ceil($this->total / $this->perPage);
    }
}
