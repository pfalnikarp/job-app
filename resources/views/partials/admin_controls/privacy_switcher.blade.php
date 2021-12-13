@role('admin')

    <a href="javascript:void(0)" v-on:click="showPrivate()" v-show="!showPrivateMessages">
        <i class="fa fa-eye text-success"></i>
        Show Private Messages
    </a>
    <a href="javascript:void(0)" v-on:click="hidePrivate()" v-show="showPrivateMessages">
        <i class="fa fa-eye-slash text-danger"></i>
        Hide Private Messages
    </a>

@endrole