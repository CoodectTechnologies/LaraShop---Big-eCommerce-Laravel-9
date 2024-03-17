<div>
    <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
        <div class="tab-content">
            <ul class="comments list-style-none">
                @foreach ($comments as $comment)
                    <li class="comment">
                        <div class="comment-body">
                            <figure class="comment-avatar">
                                <img src="{{ $comment->imageUserPreview() }}"
                                    alt="{{ $comment->name }}" width="90" height="90">
                            </figure>
                            <div class="comment-content">
                                <h4 class="comment-author">
                                    <a href="#">{{ $comment->name }}</a>
                                    <span class="comment-date">{{ $comment->dateToString() }}</span>
                                </h4>
                                <div class="ratings-container comment-rating">
                                    <div class="ratings-full">
                                        <span class="ratings"
                                            style="width: {{ $comment->getPercentage() }}%;"></span>
                                        <span
                                            class="tooltiptext tooltip-top"></span>
                                    </div>
                                </div>
                                <p>{{ $comment->body }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
                {{ $comments->links() }}
            </ul>
        </div>
    </div>
</div>
