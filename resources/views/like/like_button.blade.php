@if (Auth::id() != $user->id)
  @if (Auth::user()->is_like($user->id))
    <form method="POST" action="{{ route('user.dislike',$user->id) }}" accept-charset="UTF-8">
      @csrf
      <input name="_method" type="hidden" value="DELETE">
      <input class="btn btn-danger user-button mb-3 dislike" type="submit" value="いいねを取り消す">
    </form>
 
  @else
    <form  method="POST" action="{{ route('user.like',$user->id) }}" >
      @csrf
      <button type="submit" class="btn btn-info user-button mb-3 like"><i class="far fa-thumbs-up text-white mr-2"></i>いいね！</button>
    </form>
  @endif
@endif   
  