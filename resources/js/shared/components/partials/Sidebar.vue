<script setup>
import { computed, ref } from 'vue';
import profile from '@/assets/images/profile.png';
import NavLink from './NavLink.vue';
import { usePage, router } from '@inertiajs/vue3';

const page = usePage();
const user = computed( () => page.props.auth.user);
const sidebarStatus = ref(false);

const toggleSidebar = () => {
    sidebarStatus.value = !sidebarStatus.value;
}

const logout = () => {
    router.post(route('logout'));
}


</script>

<template>

    <div class="flex items-center py-2 md:hidden bg-white shadow">
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="flex items-center p-2  ms-3 text-sm text-purple-600 rounded-lg md:hidden hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600" id = "sidebar-button" @click="toggleSidebar">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>
        <p class = "p-2 font-bold text-lg uppercase text-purple-600">Expense Management</p>
    </div>



 
    <aside id="default-sidebar" :class="sidebarStatus ? 'fixed top-0 left-0 z-40 w-64 h-screen transition-transform md:translate-x-0' : 'fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full md:translate-x-0'" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-purple-700"> 
            <!-- menu and close button show only when in sm screen -->
            <div class="lg:hidden md:hidden mb-4">
                <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center" @click="toggleSidebar">
                    <svg aria-hidden="true" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close menu</span>
                </button>
            </div>
            
            <div class="profile flex items-center gap-4">
                <img :src = "profile" alt="profile-picture" class = "w-14">
                <div>
                    <p class="text-white text-lg font-bold">{{ user.name }}</p>
                    <p class="text-white text-sm">{{ user.role }}</p>
                </div>
            </div>

            <hr class="my-2"/>
            <ul class="space-y-2 font-medium">
                <li>
                    <NavLink routerName = "dashboard">
                        Dashboard
                    </NavLink>
                </li>
                
                <hr/>
            
                <div v-if = "user.role == 'ADMIN'">
                    <li>
                        <p class="text-white m-2 font-medium">User Management</p>
                        <NavLink routerName = "roles.index">
                            Roles
                        </NavLink>
                        
                        <NavLink routerName = "users.index">
                            Users
                        </NavLink>
                        
                    </li>
                    <hr class="m-2"/>        
                </div>
                <li>
                    <p class="text-white m-2 font-medium">Expense Categories</p>
                    <NavLink routerName = "expense_categories.index">
                        Expense Category
                    </NavLink>
                    <NavLink routerName = "expenses.index">
                        Expenses
                    </NavLink>
                </li>
                
                <hr class="my-2"/>
                <li>
                    <p class="text-white m-2 font-medium">Settings</p>
                    <NavLink routerName = "profile.index">
                        Profile
                    </NavLink>
                </li>

                <li class = "absolute bottom-5 left-3 right-3 lg:hidden md:hidden">
                    <!-- <NavLink routerName = "logout">
                        Log out
                    </NavLink> -->
                    <button @click = "logout" class="w-full pl-4 flex items-center p-2 text-slate-100 rounded-lg hover:bg-purple-500 group ">Log out</button>
                </li>
            </ul>
        </div>
    </aside> 
    
</template>