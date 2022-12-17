import {useState} from "react";
import {useMediaQuery} from '@react-hook/media-query';
import TableMobile from "./TableMobile";
import {ArrowSmallDownIcon, ArrowSmallUpIcon, ArrowsUpDownIcon} from "@heroicons/react/24/outline";

export default function Table({head, body, searchable}) {

    const isMobile = useMediaQuery('(max-width: 600px)')

    const [sorting, setSorting] = useState(false)
    const [search, setSearch] = useState('')
    const filteredData = body && body.filter(
        items => items.some(
            item => (item?.key || item?.props?.searchableText || item).toString().toLocaleLowerCase('TR').includes(search.toLocaleLowerCase('TR'))
        )
    ).sort((a, b) => {
        if (sorting?.orderBy === 'asc') {
            return (a[sorting.key]?.key || a[sorting.key]?.props?.searchableText || a[sorting.key]).toString().localeCompare(b[sorting.key]?.key || b[sorting.key]?.props?.searchableText || b[sorting.key])
        }
        if (sorting?.orderBy === 'desc') {
            return b[sorting.key].toString().localeCompare(a[sorting.key])
        }
    })

    if (!body || body?.length === 0) {
        return (
            <div className="p-4 rounded bg-gray-100 text-blue dark:bg-gray-900 text-sm">Gösterilecek veri bulunmuyor.</div>
        )
    }

    return (
        <>
            {searchable && (
                <div className="p-4 mb-4 flex gap-x-2">
                    <input
                        value={search}
                        onChange={e => setSearch(e.target.value)}
                        type="text"
                        placeholder="Tabloda ara"
                        className="border border-blue-700 focus:border-blue-100 dark:bg-gray-900 text-sm rounded-lg w-full p-2.5"
                    />
                </div>
            )}
            {isMobile && <TableMobile head={head} body={filteredData}/>}
            {!isMobile && (
                <div className="w-full rounded p4">
                    <table className="w-full">
                        <thead>
                        <tr>
                            {head.map((h, key) => (
                                <th
                                    width={h?.width}
                                    className="text-left bg-gray-50 dark:bg-gray-900 text-sm font-semibold text-gray-500 dark:text-white p-3"
                                    key={key}>
                                    <div className="inline-flex items-center gap-x-2">
                                        {h.name}
                                        {h.sortable && (
                                            <button onClick={() => {
                                                if (sorting?.key === key) {
                                                    setSorting({
                                                        key,
                                                        orderBy: sorting.orderBy === 'asc' ? 'desc' : 'asc'
                                                    })
                                                } else {
                                                    setSorting({
                                                        key,
                                                        orderBy: 'asc'
                                                    })
                                                }
                                            }}>
                                                {sorting?.key === key && (
                                                    sorting.orderBy === 'asc' ? <ArrowSmallDownIcon className="w-3 h-3"/> : <ArrowSmallUpIcon className="w-3 h-3"/>
                                                )}
                                                {sorting?.key !== key && <ArrowsUpDownIcon className="w-3 h-3"/>}
                                            </button>
                                        )}
                                    </div>
                                </th>
                            ))}
                        </tr>
                        </thead>
                        <tbody>
                        {filteredData.map((items, key) => (
                            <tr className="group" key={key}>
                                {items.map((item, key) => (
                                    <td
                                        className="p-3 text-sm group-hover:bg-blue-50 dark:group-hover:bg-gray-900 group-hover:text-blue-600"
                                        key={key}>
                                        {Array.isArray(item) ? (
                                            <div className="flex gap-x-2.5">
                                                {item}
                                            </div>
                                        ) : item}
                                    </td>
                                ))}
                            </tr>
                        ))}
                        </tbody>
                    </table>
                </div>
            )}
        </>
    )
}
