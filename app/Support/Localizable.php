<?php

namespace App\Support;

trait Localizable
{
    /**
     * Return the localized value for a field, falling back to the base
     * (Indonesian) value when no English translation exists yet.
     */
    public function localized(string $field): mixed
    {
        if (app()->getLocale() === 'en') {
            $en = $this->{$field.'_en'} ?? null;

            if (! blank($en)) {
                return $en;
            }
        }

        return $this->{$field};
    }

    /**
     * Return the slug to use in public URLs for the current locale.
     */
    public function routeSlug(): ?string
    {
        return $this->localized('slug');
    }

    /**
     * True when an English value exists for the given field.
     */
    public function hasTranslation(string $field): bool
    {
        return ! blank($this->{$field.'_en'} ?? null);
    }
}
