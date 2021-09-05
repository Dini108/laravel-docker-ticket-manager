import jQuery from 'jquery';
window.jQuery = window.$ = jQuery;

import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
window.Calendar = Calendar;
window.timeGridPlugin = timeGridPlugin;

import moment from 'moment';
window.moment = moment;

import 'datatables.net-bs4'
import DataTables from 'datatables.net-dt';
window.dataTables = DataTables;

import DataTableButtons from 'datatables-buttons'
window.dataTables.buttons = DataTableButtons;

import pdfMake from 'pdfmake'
window.pdfMake = pdfMake;

require('./bootstrap');
