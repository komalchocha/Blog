<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
                    $result .= '<button class="btn btn-success user_edit_modal"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></button>               
                    <button class="btn btn-danger delete_user"  data-id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button>';                
                    return $result;
                
               
            })
            ->editColumn('image', function ($data) {
                if ($data->image) {
                    return '<img src="' . $data->image . '" class="rounded" style="width:60px; height:60px; object-fit: cover; border-radius:0px;"/>';
                }
            })
         
        
            ->rawColumns(['action','image'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('user-table')
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
                  Column::make('image')->title('Profile'),
                  Column::make('name')->title('User Name'),
                  Column::make('email')->title('Email'),
                  Column::make('mobile_number')->title('Mobile Number'),
                  Column::make('gender')->title('Gender'),
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
        return 'User_' . date('YmdHis');
    }
}
