<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerFU87yEF\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerFU87yEF/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerFU87yEF.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerFU87yEF\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerFU87yEF\srcApp_KernelDevDebugContainer(array(
    'container.build_hash' => 'FU87yEF',
    'container.build_id' => 'c14d1f8f',
    'container.build_time' => 1550032650,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerFU87yEF');
