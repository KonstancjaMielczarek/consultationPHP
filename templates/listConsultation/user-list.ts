import './user-list.css';
import {Student, greeter} from './greeter';

export class UserList {

    public constructor() {
        //($('#data-table') as any).DataTable();

        ($('#data-table') as any).DataTable({
            'processing': true,
            'serverSide': true,
            'language': {
                //  'url': __('js/datatable-english.json')
            },
            'ajax': {
                'url': 'listConsultation/datatable',
                'type': 'POST'
            },
            'columns': [
                {'data': 'date'},
                {'data': 'start_hour'},
                {'data': 'end_hour'},
                {'data': 'name'},
                {'data': 'surname'},
                {'data': 'email'},
                {'data': 'subject'},
                {'data': 'status'},

                {
                    'orderable': false,
                    'searchable': false,
                    'data': null,
                    'render': function (data: any, type: any, row: any, meta: any) {
                        return '<button type="button" class="btn btn-info">Edit</button>';
                    }
                }
            ],
        });
    };

    public demo() {
        return $('#myButton').html();
    }
};

$(function () {

    let user = new Student("Jane", "M.", "User");

    greeter(user);

    new UserList();
});
