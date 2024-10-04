import './bootstrap';
import 'flowbite';
import {initFlowbite} from "flowbite"
import Alpine from 'alpinejs';

window.Alpine = Alpine;
initFlowbite()


Alpine.start();

function formatRupiah(value) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(value);
}