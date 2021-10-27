export function UsePaginate() {

	
	const paginateArray = (array, page_number,per_page, ) => {
		return array.slice(
			(page_number - 1) * per_page,
			page_number * per_page
		);
	}

	return {
		paginateArray
	}

}