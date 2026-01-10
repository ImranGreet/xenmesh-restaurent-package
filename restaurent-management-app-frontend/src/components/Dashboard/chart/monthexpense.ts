import type { ChartOptions } from 'chart.js';

export const data = {
	labels: [
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December',
	],
	datasets: [
		{
			label: 'Expense',
			backgroundColor: '#ef4444',
			data: [
				3600, 3200, 3400, 3600, 3500, 3700, 3600, 3650, 3800, 3500,
				3700, 3900,
			],
		},
		{
			label: 'Income',
			backgroundColor: '#22c55e', 
			data: [
				4000, 4500, 3800, 3900, 4200, 4600, 4100, 4300, 4400, 4100,
				4700, 5200,
			],
		},
	],
};

export const options: ChartOptions<'bar'> = {
	responsive: true,
	maintainAspectRatio: false,
	plugins: {
		legend: {
			position: 'bottom',
		},
		title: {
			display: true,
			text: 'Monthly Income vs Expense',
		},
	},
	scales: {
		x: {
			stacked: false, 
		},
		y: {
			beginAtZero: true,
		},
	},
};
