<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPIZWqHO\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPIZWqHO/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerPIZWqHO.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerPIZWqHO\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerPIZWqHO\srcApp_KernelDevDebugContainer(array(
    'container.build_hash' => 'PIZWqHO',
    'container.build_id' => '30a296ca',
    'container.build_time' => 1552235087,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerPIZWqHO');
