<title>{{isset($data->seo_title) ? $data->seo_title : $data->title}}</title>
<meta type="keywords" content="{{isset($data->keywords) ? $data->keywords : ''}}">
<meta type="description" content="{{isset($data->description) ? $data->description : ''}}">
<link rel="canonical" href="{{isset($data->canonical_url) ? $data->canonical_url : ''}}" >

