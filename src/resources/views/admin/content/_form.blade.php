{!! Form::model($content, ['id' => 'form', 'enctype'=>'multipart/form-data','files'=> true]) !!}
  <div class="l-container">
    <div class="l-edit__main">
      <div class="p-input">
        <ul class="p-input__list">
          <li>
            <div class="c-input c-input--full {{ $errors->has('title') ? 'c-input--error' : ''}}" data-title="タイトル">
              {{ Form::text('title', old('title'), ['placeholder' => 'タイトル', 'autofocus' => true]) }}
            </div>
            @error('title')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li>
            <!-- エディタ -->
            <div class="p-editor">
              {{ Form::hidden('body', null, ['id' => 'bodyInput']) }}
              <div id="quillEditor" style="height: 500px;">{!! old('body', $content->body) !!}</div>
            </div>
            @error('body')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
        </ul>
      </div>
    </div>
    <div class="l-edit__sidebar">
      <ul class="p-list">
        <li>
          <div class="p-list__label">
            記事カテゴリー
          </div>
          <div class="p-list__data">
            <div class="c-input--radio c-input--required c-input--select {{ $errors->has('text_category_id') ? 'c-input--error' : ''}}">
              {{ Form::select('category_id', config('const.CONTENT_CATEGORY'), old('text_category_id', null), ['placeholder' => '選択してください'])}}
            </div>
          </div>
          @error('text_category_id')
            <div class="p-formError">
              <p class="message">{{ $message }}</p>
            </div>
          @enderror
        </li>
        <li>
          <div class="p-list__label">
            タグ
          </div>
          <div class="p-list__data">
            <div class="c-input--radio c-input--required c-input--select {{ $errors->has('text_category_id') ? 'c-input--error' : ''}}">
              {{ Form::select('tag_id', config('const.PROGRAMMING_CATEGORY'), old('text_category_id', null), ['placeholder' => '選択してください'])}}
            </div>
          </div>
          @error('text_category_id')
            <div class="p-formError">
              <p class="message">{{ $message }}</p>
            </div>
          @enderror
        </li>
        <li>
          <div class="p-list__label">
            見出し記事
          </div>
          <div class="p-list__data">
            <div class="c-input--checkbox c-input--checkbox--column">
              {{ Form::hidden('headline_flg', \App\Models\Content::STATUS_2) }}
              {{ Form::checkbox('headline_flg', \App\Models\Content::STATUS_1, $content->headline_flg == \App\Models\Content::STATUS_1 ? true : false, ['id' => "headline_flg"]) }}
              {{ Form::label("headline_flg", '見出し記事') }}
            </div>
          </div>
        </li>
        <li>
          <div class="p-list__label">
            公開箇所
          </div>
          <div class="p-list__data">
            <div class="c-input--checkbox c-input--checkbox--column">
              {{ Form::hidden('web_release', \App\Models\News::STATUS_2) }}
              {{ Form::checkbox('web_release', \App\Models\News::STATUS_1, $content->web_release == \App\Models\News::STATUS_1 ? true : false, ['id' => "showPlace--01"]) }}
              {{ Form::label("showPlace--01", 'Webサイト') }}
            </div>
          </div>
        </li>
        <li>
          <div class="p-list__label">
            公開日
          </div>
          <div class="p-list__data">
            <div class="c-input c-input--full {{ $errors->has('release_date') ? 'c-input--error' : ''}}">
              {{ Form::date('release_date', old('release_date'), [ "class" => "calendar"]) }}
            </div>
          </div>
          @error('release_date')
            <div class="p-formError">
              <p class="message">{{ $message }}</p>
            </div>
          @enderror
        </li>
        <li>
          <div class="p-list__label">
            サムネイル画像
          </div>
          <div class="p-list__data">
            <div class="p-list__data">
              <div class="c-input--file">
                <div class="c-button c-button--remove js-trigger__photoList--remove delete_image"></div>
                <label for="postImage__main" id="main-image" class="c-image c-image--wide">
                  {{ Form::file('image_path', ['id' => 'postImage__main','accept' => 'image/*', 'enctype' => 'multipart/form-data', 'class' => 'file_img_preview']) }}
                  {!! Form::hidden('image_path', isset($content->image_path) ? $content->image_path : '' ) !!}
                </label>
              </div>
            </div>
          </div>
          <div class="p-list__label">
            ＊画像アップロードサイズは200MBまでとなります
          </div>
        </li>
      </ul>
    </div>
  </div>
{!! Form::close() !!}

@include('admin.content._form_script')
