<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', trans('validation.attributes.backend.banner.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.banner.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
    <div class="form-group">
        {{ Form::label('url', trans('validation.attributes.backend.banner.url'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            {{ Form::text('url', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.banner.url'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('image_url', trans('validation.attributes.backend.banner.image'), ['class' => 'col-lg-2 control-label required']) }}
        @if(!empty($banners->image_url))
            <div class="col-lg-1">
                <img src="{{ Storage::disk('public')->url('img/banner/' . $banners->image_url) }}" height="80"
                     width="80">
            </div>
            <div class="col-lg-5">
                <div class="custom-file-input">
                    <input type="file" name="image_url" id="file-1" class="inputfile inputfile-1"
                           data-multiple-caption="{count} files selected"/>
                    <label for="file-1"><i class="fa fa-upload"></i><span>Choose a file</span></label>
                </div>
            </div>
        @else
            <div class="col-lg-5">
                <div class="custom-file-input">
                    <input type="file" name="image_url" id="file-1" class="inputfile inputfile-1"
                           data-multiple-caption="{count} files selected"/>
                    <label for="file-1"><i class="fa fa-upload"></i><span>Choose a file</span></label>
                </div>
            </div>
        @endif
    </div><!--form control-->

    <div class="form-group">
        {{ Form::label('description', trans('validation.attributes.backend.banner.description'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10 mce-box">
            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.banner.description')]) }}
        </div><!--col-lg-10-->
    </div><!--form control-->
</div>
@section("after-scripts")
    <script type="text/javascript">
      //Put your javascript needs in here.
      //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
      //if your create or edit blade contains javascript of its own
      $(document).ready(function() {
        //Everything in here would execute after the DOM is ready to manipulated.
      });
    </script>
@endsection
