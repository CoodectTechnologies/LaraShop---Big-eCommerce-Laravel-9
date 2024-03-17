<div>
    @if (session()->has('alert-comment'))
        <div class="alert alert-{{ session()->get('alert-comment-type') }} alert-simple alert-inline">
            <h4 class="alert-title">{{ session()->get('alert-comment') }}</h4>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="ratings-wrapper">
                <div class="avg-rating-container">
                    <h4 class="avg-mark font-weight-bolder ls-50">{{ $model->getStarsAVG() }}</h4>
                    <div class="avg-rating">
                        <p class="text-dark mb-1">{{ __('Average rating') }}</p>
                        <div class="ratings-container">
                            <div class="ratings-full">
                                <span class="ratings" style="width: {{ $model->getStarsPercentageAVG() }}%;"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <a href="#" class="rating-reviews">({{ $model->comments()->validate()->count() }} {{ __('Reviews') }})</a>
                        </div>
                    </div>
                </div>
                <div wire:ignore class="ratings-list">
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 100%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <div class="progress-bar progress-bar-sm ">
                            <span></span>
                        </div>
                        <div class="progress-value">
                            <mark>{{ $model->getStarsPercentage(5) }}%</mark>
                        </div>
                    </div>
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 80%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <div class="progress-bar progress-bar-sm ">
                            <span></span>
                        </div>
                        <div class="progress-value">
                            <mark>{{ $model->getStarsPercentage(4) }}%</mark>
                        </div>
                    </div>
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 60%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <div class="progress-bar progress-bar-sm ">
                            <span></span>
                        </div>
                        <div class="progress-value">
                            <mark>{{ $model->getStarsPercentage(3) }}%</mark>
                        </div>
                    </div>
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 40%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <div class="progress-bar progress-bar-sm ">
                            <span></span>
                        </div>
                        <div class="progress-value">
                            <mark>{{ $model->getStarsPercentage(2) }}%</mark>
                        </div>
                    </div>
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 20%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <div class="progress-bar progress-bar-sm ">
                            <span></span>
                        </div>
                        <div class="progress-value">
                            <mark>{{ $model->getStarsPercentage(1) }}%</mark>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="review-form-wrapper">
                <h3 class="title tab-pane-title font-weight-bold mb-1">{{ __('Submit your review') }}</h3>
                <p class="mb-3">{{ __('Your email address will not be published. Required fields are marked') }} *<p>
                <form wire:submit.prevent="store" class="review-form">
                    <div class="rating-form">
                        <label for="rating">{{ __('Your rating') }} :</label>
                        <span class="rating-stars">
                            <a wire:click.prevent="$set('comment.stars', 1)" class="star-1 {{ $comment->stars == 1 ? 'active' : '' }}">1</a>
                            <a wire:click.prevent="$set('comment.stars', 2)" class="star-2 {{ $comment->stars == 2 ? 'active' : '' }}">2</a>
                            <a wire:click.prevent="$set('comment.stars', 3)" class="star-3 {{ $comment->stars == 3 ? 'active' : '' }}">3</a>
                            <a wire:click.prevent="$set('comment.stars', 4)" class="star-4 {{ $comment->stars == 4 ? 'active' : '' }}">4</a>
                            <a wire:click.prevent="$set('comment.stars', 5)" class="star-5 {{ $comment->stars == 5 ? 'active' : '' }}">5</a>
                        </span>
                        @error('comment.stars') <small class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>

                    <textarea wire:model.defer="comment.body" cols="30" rows="6" placeholder="{{ __('Write your review here') }}..." class="form-control" id="review"></textarea>
                    @error('comment.body') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror

                    <div class="row gutter-md">
                        <div class="col-md-6">
                            <input wire:model.defer="comment.name" type="text" class="form-control" placeholder="{{ __('Your name') }}" id="">
                            @error('comment.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <input wire:model.defer="comment.email" type="email" class="form-control" placeholder="{{ __('Your email') }}" id="">
                            @error('comment.email') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <x-honey recaptcha="contact"/>
                    <button
                        wire:target="store"
                        wire:loading.class="load-more-overlay loading"
                        wire:loading.disabled
                        class="btn btn-dark"
                        type="submit">{{ __('Submit review') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
