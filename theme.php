<?php

/**
 * Bootstrap Blog
 */

use Atomastic\Arrays\Arrays;
use Atomastic\Macroable\Macroable;

Arrays::macro('onlyFromCollection', function(array $keys) {
    $result = [];

    foreach ($this->toArray() as $key => $value) {
        $result[$key] = arrays($value)->only($keys)->toArray();
    }

    return arrays($result);
});

Arrays::macro('exceptFromCollection', function(array $keys) {
    $result = [];

    foreach ($this->toArray() as $key => $value) {
        $result[$key] = arrays($value)->except($keys)->toArray();
    }

    return arrays($result);
});

$blogCollectionCacheID = strings('blog-collection-' . flextype('registry')
                                                            ->get('themes.bootstrap-blog.settings.blog_id'))
                                                            ->hash()
                                                            ->toString();


flextype('emitter')->addListener('onEntriesCreate', function () use ($blogCollectionCacheID) {
    flextype('cache')->delete($blogCollectionCacheID);
});

flextype('emitter')->addListener('onEntriesDelete', function () use ($blogCollectionCacheID) {
    flextype('cache')->delete($blogCollectionCacheID);
});

flextype('emitter')->addListener('onEntriesCopy', function () use ($blogCollectionCacheID) {
    flextype('cache')->delete($blogCollectionCacheID);
});

flextype('emitter')->addListener('onEntriesMove', function () use ($blogCollectionCacheID) {
    flextype('cache')->delete($blogCollectionCacheID);
});

flextype('emitter')->addListener('onEntriesUpdate', function () use ($blogCollectionCacheID) {
    flextype('cache')->delete($blogCollectionCacheID);
});
