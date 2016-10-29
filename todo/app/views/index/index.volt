<div class="list">
    <div class="header"><h2>TODO</h2></div>
    <div class="events">
        <div class="event add-event">
            <div class="event-details">
                <div class="content-wrapper">
                    <a class="content-text">添加事件</a>
                </div>
                <div class="content-textarea">
                    <textarea></textarea>
                    <a id="addEventBtn" class="btn btn-success">保存</a>
                    <a id="cancel" class="btn btn-default btn-xs cancel-btn"><span class="glyphicon glyphicon-remove"></a>
                </div>
            </div>
        </div>
        {% for event in events %}
        <div class="event {% if event.status == 1 %}done{% endif %}" data-id="{{ event.id }}">
            <div class="event-details">
                <div class="content-wrapper">
                    <a class="content-text">{{ event.content }}</a>
                    <div class="operation-wrapper">
                        <a id="done-btn" class="btn btn-success btn-xs done-btn"><span class="glyphicon glyphicon-ok"></span></a>
                        <a id="undone-btn" class="btn btn-info btn-xs undone-btn"><span class="glyphicon glyphicon-repeat"></span></a>
                    </div>
                </div>
                <div class="content-textarea">
                    <textarea>{{ event.content }}</textarea>
                    <a class="btn btn-success save-btn">保存</a>
                    <a id="cancel" class="btn btn-default btn-xs cancel-btn"><span class="glyphicon glyphicon-remove"></a>
                    <a class="btn btn-danger btn-xs pull-right delete-btn"><span class="glyphicon glyphicon-trash"></a>
                </div>
            </div>
        </div>
        {% endfor %}
    </div>
</div>