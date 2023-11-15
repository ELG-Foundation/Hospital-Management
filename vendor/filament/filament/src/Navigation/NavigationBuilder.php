<?php

namespace Filament\Navigation;

use Illuminate\Support\Traits\Conditionable;

class NavigationBuilder
{
    use Conditionable;

    /** @var NavigationGroup[] */
    protected array $groups = [];

    /** @var NavigationItem[] */
    protected array $items = [];

    /**
     * @param  array<NavigationItem>  $items
     */
    public function group(NavigationGroup | string $group, array $items = [], ?bool $collapsible = null): static
    {
        if ($group instanceof NavigationGroup) {
            $this->groups[] = $group;

            return $this;
        }

        $this->groups[] = NavigationGroup::make($group)
            ->items($items)
            ->collapsible($collapsible);

        return $this;
    }

    public function item(NavigationItem $item): static
    {
        $this->items[] = $item;

        return $this;
    }

    /** @param  array<NavigationGroup>  $groups */
    public function groups(array $groups): static
    {
        $this->groups = [
            ...$this->groups,
            ...$groups,
        ];

        return $this;
    }

    /** @param  array<NavigationItem>  $items */
    public function items(array $items): static
    {
        $this->items = [
            ...$this->items,
            ...$items,
        ];

        return $this;
    }

    /**
     * @return array<NavigationGroup>
     */
    public function getNavigation(): array
    {
        $navigation = collect();

        $items = $this->items;

        if (count($items)) {
            $navigation->push(
                NavigationGroup::make()->items($items),
            );
        }

        return $navigation
            ->merge($this->groups)
            ->all();
    }
}
