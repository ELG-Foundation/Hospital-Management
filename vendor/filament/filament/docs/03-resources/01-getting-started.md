---
title: Getting started
---

## Overview

Resources are static classes that are used to build CRUD interfaces for your Eloquent models. They describe how administrators should be able to interact with data from your app - using tables and forms.

## Creating a resource

To create a resource for the `App\Models\Customer` model:

```bash
php artisan make:filament-resource Customer
```

This will create several files in the `app/Filament/Resources` directory:

```
.
+-- CustomerResource.php
+-- CustomerResource
|   +-- Pages
|   |   +-- CreateCustomer.php
|   |   +-- EditCustomer.php
|   |   +-- ListCustomers.php
```

Your new resource class lives in `CustomerResource.php`.

The classes in the `Pages` directory are used to customize the pages in the app that interact with your resource. They're all full-page [Livewire](https://livewire.laravel.com) components that you can customize in any way you wish.

> Have you created a resource, but it's not appearing in the navigation menu? If you have a [model policy](#authorization), make sure you return `true` from the `viewAny()` method.

### Simple (modal) resources

Sometimes, your models are simple enough that you only want to manage records on one page, using modals to create, edit and delete records. To generate a simple resource with modals:

```bash
php artisan make:filament-resource Customer --simple
```

Your resource will have a "Manage" page, which is a List page with modals added.

Additionally, your simple resource will have no `getRelations()` method, as [relation managers](relation-managers) are only displayed on the Edit and View pages, which are not present in simple resources. Everything else is the same.

### Automatically generating forms and tables

If you'd like to save time, Filament can automatically generate the [form](#resource-forms) and [table](#resource-tables) for you, based on your model's database columns, using `--generate`:

```bash
php artisan make:filament-resource Customer --generate
```

> If your table contains ENUM columns, the `doctrine/dbal` package we use is unable to scan your table and will crash. Hence, Filament is unable to generate the schema for your resource if it contains an ENUM column. Read more about this issue [here](https://github.com/doctrine/dbal/issues/3819#issuecomment-573419808).

### Handling soft deletes

By default, you will not be able to interact with deleted records in the app. If you'd like to add functionality to restore, force delete and filter trashed records in your resource, use the `--soft-deletes` flag when generating the resource:

```bash
php artisan make:filament-resource Customer --soft-deletes
```

You can find out more about soft deleting [here](deleting-records#handling-soft-deletes).

### Generating a View page

By default, only List, Create and Edit pages are generated for your resource. If you'd also like a [View page](viewing-records), use the `--view` flag:

```bash
php artisan make:filament-resource Customer --view
```

## Record titles

A `$recordTitleAttribute` may be set for your resource, which is the name of the column on your model that can be used to identify it from others.

For example, this could be a blog post's `title` or a customer's `name`:

```php
protected static ?string $recordTitleAttribute = 'name';
```

This is required for features like [global search](global-search) to work.

> You may specify the name of an [Eloquent accessor](https://laravel.com/docs/eloquent-mutators#defining-an-accessor) if just one column is inadequate at identifying a record.

## Resource forms

Resource classes contain a `form()` method that is used to build the forms on the [Create](creating-records) and [Edit](editing-records) pages:

```php
use Filament\Forms;
use Filament\Forms\Form;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('email')->email()->required(),
            // ...
        ]);
}
```

The `schema()` method is used to define the structure of your form. It is an array of [fields](../../forms/fields/getting-started#available-fields) and [layout components](../../forms/layout/getting-started#available-layout-components), in the order they should appear in your form.

Check out the Forms docs for a [guide](../../forms/getting-started) on how to build forms with Filament.

### Hiding components based on the current operation

The `hiddenOn()` method of form components allows you to dynamically hide fields based on the current page or action.

In this example, we hide the `password` field on the `edit` page:

```php
use Livewire\Component;

Forms\Components\TextInput::make('password')
    ->password()
    ->required()
    ->hiddenOn('edit'),
```

Alternatively, we have a `visibleOn()` shortcut method for only showing a field on one page or action:

```php
use Livewire\Component;

Forms\Components\TextInput::make('password')
    ->password()
    ->required()
    ->visibleOn('create'),
```

## Resource tables

Resource classes contain a `table()` method that is used to build the table on the [List page](listing-records):

```php
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('email'),
            // ...
        ])
        ->filters([
            Tables\Filters\Filter::make('verified')
                ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
            // ...
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}
```

Check out the [tables](../../tables/getting-started) docs to find out how to add table columns, filters, actions and more.

## Authorization

For authorization, Filament will observe any [model policies](https://laravel.com/docs/authorization#creating-policies) that are registered in your app. The following methods are used:

- `viewAny()` is used to completely hide resources from the navigation menu, and prevents the user from accessing any pages.
- `create()` is used to control [creating new records](creating-records).
- `update()` is used to control [editing a record](editing-records).
- `view()` is used to control [viewing a record](viewing-records).
- `delete()` is used to prevent a single record from being deleted. `deleteAny()` is used to prevent records from being bulk deleted. Filament uses the `deleteAny()` method because iterating through multiple records and checking the `delete()` policy is not very performant.
- `forceDelete()` is used to prevent a single soft-deleted record from being force-deleted. `forceDeleteAny()` is used to prevent records from being bulk force-deleted. Filament uses the `forceDeleteAny()` method because iterating through multiple records and checking the `forceDelete()` policy is not very performant.
- `restore()` is used to prevent a single soft-deleted record from being restored. `restoreAny()` is used to prevent records from being bulk restored. Filament uses the `restoreAny()` method because iterating through multiple records and checking the `restore()` policy is not very performant.
- `reorder()` is used to control [reordering a record](listing-records#reordering-records).

### Skipping authorization

If you'd like to skip authorization for a resource, you may set the `$shouldSkipAuthorization` property to `true`:

```php
protected static bool $shouldSkipAuthorization = true;
```

## Customizing the model label

Each resource has a "model label" which is automatically generated from the model name. For example, an `App\Models\Customer` model will have a `customer` label.

The label is used in several parts of the UI, and you may customize it using the `$modelLabel` property:

```php
protected static ?string $modelLabel = 'cliente';
```

Alternatively, you may use the `getModelLabel()` to define a dynamic label:

```php
public static function getModelLabel(): string
{
    return __('filament/resources/customer.label');
}
```

### Customizing the plural model label

Resources also have a "plural model label" which is automatically generated from the model label. For example, a `customer` label will be pluralized into `customers`.

You may customize the plural version of the label using the `$pluralModelLabel` property:

```php
protected static ?string $pluralModelLabel = 'clientes';
```

Alternatively, you may set a dynamic plural label in the `getPluralModelLabel()` method:

```php
public static function getPluralModelLabel(): string
{
    return __('filament/resources/customer.plural_label');
}
```

## Resource navigation items

Filament will automatically generate a navigation menu item for your resource using the [plural label](#plural-label).

If you'd like to customize the navigation item label, you may use the `$navigationLabel` property:

```php
protected static ?string $navigationLabel = 'Mis Clientes';
```

Alternatively, you may set a dynamic navigation label in the `getNavigationLabel()` method:

```php
public static function getNavigationLabel(): string
{
    return __('filament/resources/customer.navigation_label');
}
```

### Setting a resource navigation icon

The `$navigationIcon` property supports the name of any Blade component. By default, [Heroicons](https://heroicons.com) are installed. However, you may create your own custom icon components or install an alternative library if you wish.

```php
protected static ?string $navigationIcon = 'heroicon-o-user-group';
```

Alternatively, you may set a dynamic navigation icon in the `getNavigationIcon()` method:

```php
public static function getNavigationIcon(): ?string
{
    return 'heroicon-o-user-group';
}
```

### Sorting resource navigation items

The `$navigationSort` property allows you to specify the order in which navigation items are listed:

```php
protected static ?int $navigationSort = 2;
```

Alternatively, you may set a dynamic navigation item order in the `getNavigationSort()` method:

```php
public static function getNavigationSort(): ?int
{
    return 2;
}
```

### Grouping resource navigation items

You may group navigation items by specifying a `$navigationGroup` property:

```php
protected static ?string $navigationGroup = 'Shop';
```

Alternatively, you may use the `getNavigationGroup()` method to set a dynamic group label:

```php
public static function getNavigationGroup(): ?string
{
    return __('filament/navigation.groups.shop');
}
```

## Generating URLs to resource pages

Filament provides `getUrl()` static method on resource classes to generate URLs to resources and specific pages within them. Traditionally, you would need to construct the URL by hand or by using Laravel's `route()` helper, but these methods depend on knowledge of the resource's slug or route naming conventions.

The `getUrl()` method, without any arguments, will generate a URL to the resource's [List page](listing-records):

```php
use App\Filament\Resources\CustomerResource;

CustomerResource::getUrl(); // /admin/customers
```

You may also generate URLs to specific pages within the resource. The name of each page is the array key in the `getPages()` array of the resource. For example, to generate a URL to the [Create page](creating-records):

```php
use App\Filament\Resources\CustomerResource;

CustomerResource::getUrl('create'); // /admin/customers/create
```

Some pages in the `getPages()` method use URL parameters like `record`. To generate a URL to these pages and pass in a record, you should use the second argument:

```php
use App\Filament\Resources\CustomerResource;

CustomerResource::getUrl('edit', ['record' => $customer]); // /admin/customers/edit/1
```

In this example, `$customer` can be an Eloquent model object, or an ID.

If you have multiple panels in your app, `getUrl()` will generate a URL within the current panel. You can also indicate which panel the resource is associated with, by passing the panel ID to the `panel` argument:

```php
use App\Filament\Resources\CustomerResource;

CustomerResource::getUrl(panel: 'marketing');
```

## Customizing the resource Eloquent query

Within Filament, every query to your resource model will start with the `getEloquentQuery()` method.

Because of this, it's very easy to apply your own query constraints or [model scopes](https://laravel.com/docs/eloquent#query-scopes) that affect the entire resource:

```php
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->where('is_active', true);
}
```

### Disabling global scopes

By default, Filament will observe all global scopes that are registered to your model. However, this may not be ideal if you wish to access, for example, soft deleted records.

To overcome this, you may override the `getEloquentQuery()` method that Filament uses:

```php
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->withoutGlobalScopes();
}
```

Alternatively, you may remove specific global scopes:

```php
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->withoutGlobalScopes([ActiveScope::class]);
}
```

More information about removing global scopes may be found in the [Laravel documentation](https://laravel.com/docs/eloquent#removing-global-scopes).

## Customizing the resource URL

By default, Filament will generate a URL based on the name of the resource. You can customize this by setting the `$slug` property on the resource:

```php
protected static ?string $slug = 'pending-orders';
```

## Deleting resource pages

If you'd like to delete a page from your resource, you can just delete the page file from the `Pages` directory of your resource, and its entry in the `getPages()` method.

For example, you may have a resource with records that may not be created by anyone. Delete the `Create` page file, and then remove it from `getPages()`:

```php
public static function getPages(): array
{
    return [
        'index' => Pages\ListCustomers::route('/'),
        'edit' => Pages\EditCustomer::route('/{record}/edit'),
    ];
}
```

Deleting a page will not delete any actions that link to that page. Any actions will open a modal instead of sending the user to the non-existant page. For instance, the `CreateAction` on the List page, the `EditAction` on the table or View page, or the `ViewAction` on the table or Edit page. If you want to remove those buttons, you must delete the actions as well.
