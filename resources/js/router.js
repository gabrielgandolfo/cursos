import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from './components/Dashboard.vue';
import Courses from './components/Courses.vue';
import AddCourse from './components/AddCourse.vue';
import EditCourse from './components/EditCourse.vue';
import Students from './components/Students.vue';
import AddStudent from './components/AddStudent.vue';
import EditStudent from './components/EditStudent.vue';
import Enrollments from './components/Enrollments.vue';
import AddEnrollment from './components/AddEnrollment.vue';
import EditEnrollment from './components/EditEnrollment.vue';

const routes = [
    { path: '/', component: Dashboard },
    { path: '/courses', component: Courses },
    { path: '/courses/add', component: AddCourse },
    { path: '/courses/edit/:id', component: EditCourse, props: true },
    { path: '/students', component: Students },
    { path: '/students/add', component: AddStudent },
    { path: '/students/edit/:id', component: EditStudent, props: true },
    { path: '/enrollments', component: Enrollments },
    { path: '/enrollments/add', component: AddEnrollment },
    { path: '/enrollments/edit/:id', component: EditEnrollment, props: true },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
