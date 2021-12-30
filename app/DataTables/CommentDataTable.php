<?php

namespace App\DataTables;

use App\Models\Comment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CommentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data){
                $result = "";
                $result .='<button class="btn btn-danger delete_comment"  data-id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button>';                
                return $result;
            
           
        })
        ->editColumn('blog_id', function ($data) {
            return $data->getBlogname ? $data->getBlogname->name :'';
        })
        ->editColumn('created_at', function ($request) {
            return $request->created_at->diffForHumans(); // human readable format
          })
     
        ->editColumn('user_id', function ($data) {
            return $data->getuser ? $data->getuser->name :'';
        })
        ->rawColumns(['action'])
        ->addIndexColumn();
}
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Comment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Comment $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('comment-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [             
            Column::make('id'),
            Column::make('blog_id')->title('Blog Title'),
            Column::make('user_id')->title('User'),
            Column::make('comment')->title('Comment'),
            Column::make('created_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Comment_' . date('YmdHis');
    }
}
