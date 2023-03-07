<div class="{{ $block->classes }} slider swiper">
  <div class="swiper-wrapper">
    @if(!empty($items))
      @foreach ($items as $item)
        <div class="swiper-slide overflow-hidden relative p-10 before:inset-0 before:absolute before:bg-black before:opacity-50 before:z-10">
          <img src="{{ $item['background'] }}" class="object-cover w-full h-full absolute inset-0" />

          <x-rich-text
            class="container mx-auto inner-blocks-wrapper relative h-full flex flex-col z-20"
            style="light"
            :content="$item['content']"
          />
        </div>
      @endforeach
    @endif
  </div>
</div>
