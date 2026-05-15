<div
    id="flash-notify"
    hidden
    data-success='@json(session("success"))'
    data-error='@json(session("error"))'
    data-errors='@json($errors->all())'
></div>
