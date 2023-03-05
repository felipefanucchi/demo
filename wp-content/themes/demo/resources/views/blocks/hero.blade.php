<div class="{{ $block->classes }} overflow-hidden relative p-10 before:inset-0 before:absolute before:bg-black before:opacity-50 before:z-10">
  <img src={{ $background }} class="object-cover w-full h-full absolute inset-0" />

  <div class="container mx-auto inner-blocks-wrapper relative h-full flex flex-col z-20">
    <div class="inner-blocks gap-5 grid">
      <InnerBlocks />
    </div>
  </div>
</div>
