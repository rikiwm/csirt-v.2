@props([
    'title' =>'',
    'data' => '' ,
    'link' => $link ?? null,
    'class' => 'text-center'
])
 <section class="py-2">
    <div class="container">
      <div class="row">
        <div class="mx-auto mb-5 text-center col-10">
          <span class="pb-2 mb-1 badge text-dark bg-light">Terkait Lainya</span>
          <h2 class="mb-4">{{$title}}</h2>
                <p class=" text-start">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta quidem dolor, blanditiis aperiam dolore aliquam, accusamus rerum magnam deserunt libero sapiente perferendis facere laborum ut nemo voluptas ex pariatur eveniet?
                </p>
        </div>
      </div>
    </div>
</section>
