import './bootstrap';
import '../css/app.css';

import {createApp, DefineComponent, h} from 'vue'
import {createInertiaApp} from '@inertiajs/vue3'
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers'
import {ZiggyVue} from '../../vendor/tightenco/ziggy'
import Button from "@/Components/Button.vue";
import Badge from "@/Components/Badge.vue";
import Autocomplete from "@/Components/Autocomplete.vue";
import Background from "@/Components/Background.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Card from "@/Components/Card.vue";
import Dropdown from "@/Components/Dropdown.vue";
import Footer from "@/Components/Footer.vue";
import {Input} from "postcss";
import InputFile from "@/Components/InputFile.vue";
import Logo from "@/Components/Logo.vue";
import Modal from "@/Components/Modal.vue";
import Pagination from "@/Components/Pagination.vue";
import Progress from "@/Components/Progress.vue";
import Saved from "@/Components/Saved.vue";
import Select from "@/Components/Select.vue";
import Textarea from "@/Components/Textarea.vue";
import Table from "@/Components/Table.vue";
import Alert from "@/Components/Alert.vue";
import Loading from "@/Components/Loading.vue";
import Navbar from "@/Components/Navbar.vue";
import Label from "@/Components/Label.vue";
import NavbarItem from "@/Components/NavbarItem.vue";
import DropdownItem from "@/Components/DropdownItem.vue";

const appName = import.meta.env.VITE_APP_NAME;

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)})

        app.use(plugin)
            .use(ZiggyVue)
            .component('Autocomplete', Autocomplete)
            .component('Alert', Alert)
            .component('Background', Background)
            .component('Badge', Badge)
            .component('Button', Button)
            .component('Card', Card)
            .component('Checkbox', Checkbox)
            .component('Dropdown', Dropdown)
            .component('DropdownItem', DropdownItem)
            .component('Footer', Footer)
            .component('Input', Input)
            .component('InputFile', InputFile)
            .component('Loading', Loading)
            .component('Logo', Logo)
            .component('Modal', Modal)
            .component('Navbar', Navbar)
            .component('NavbarItem', NavbarItem)
            .component('Pagination', Pagination)
            .component('Progress', Progress)
            .component('Saved', Saved)
            .component('Select', Select)
            .component('Textarea', Textarea)
            .component('Table', Table)
            .component('Label', Label)
            .mount(el);
    },
});
