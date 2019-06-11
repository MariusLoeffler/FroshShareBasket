{extends file="parent:frontend/account/sidebar.tpl"}

{namespace name="frontend/account/sidebar"}

{block name="frontend_account_menu_link_orders"}
    {$smarty.block.parent}
    {block name="frontend_account_menu_link_carts"}
        <li class="navigation--entry">
            <a href="{url module='frontend' controller='account' action=carts}" title="{s name="AccountLinkCarts"}{/s}" class="navigation--link{if {controllerName|lower} == 'account' && $sAction == 'carts'} is--active{/if}" rel="nofollow">
                {s name="AccountLinkCarts"}Carts{/s}
            </a>
        </li>
    {/block}
{/block}


